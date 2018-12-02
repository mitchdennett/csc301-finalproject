<?php
    require '../../assets/vendor/aws/aws-autoloader.php';
    include('../config.php');

    include('../functions.php');

    $gallery_id = get('id');
    $customerid = get('customerid');

    $isLogo = get('islogo');
    $isFavIcon = get('isfavicon');

    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;

    if(!empty($_FILES)){
        $bucket = 'mitchtest1';

        if($isLogo || $isFavIcon){
            $keyname = $customer->getId().'/assets/'.$_FILES['file']['name'];
        } else {
            $keyname = $customer->getId().'/'.$gallery_id.'/'.$_FILES['file']['name'];
        }
                                
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-west-2',
            'credentials' => [

            ],
            'http'    => [
                'verify' => '../../assets/cacert.pem'
            ]
        ]);

        try {
            // Upload data.
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => $keyname,
                'SourceFile'   => $_FILES['file']['tmp_name'],
                'StorageClass' => 'STANDARD'
            ]);

            // Print the URL to the object.
            echo $result['ObjectURL'] . PHP_EOL;


            if($isLogo){
                $sql = file_get_contents('../sql/insertLogoURL.sql');
                $params = array(
                    'logo' => $result['ObjectURL'],
                    'customerid' => $customerid
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);

            } else if($isFavIcon) {
                $sql = file_get_contents('../sql/insertFavIcon.sql');
                $params = array(
                    'favicon' => $result['ObjectURL'],
                    'customerid' => $customerid
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);
            } else {
                $sql = file_get_contents('../sql/insertGalleryItem.sql');
                $params = array(
                    'name' => $_FILES['file']['name'],
                    's3url' => $result['ObjectURL'],
                    'galleryid' => $gallery_id
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);
            }
        } catch (S3Exception $e) {
            echo($_FILES['file']['tmp_name']);
            echo $e->getMessage() . PHP_EOL;
        }
    }
?>