SELECT count(*) as item_count 
FROM gallery_items i
JOIN galleries g on g.galleryid=i.galleryid
WHERE g.customerid = :customerid