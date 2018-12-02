SELECT gi.* FROM gallery_items gi
JOIN galleries g on gi.galleryid=g.galleryid
WHERE gi.galleryid = :galleryid AND g.customerid = :customerid
ORDER BY case when sortvalue is null then 1 else 0 end, sortvalue