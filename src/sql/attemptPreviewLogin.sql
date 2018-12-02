SELECT gi.* FROM gallery_items gi
JOIN galleries g on gi.galleryid=g.galleryid
WHERE gi.galleryid = :galleryid AND password = :password