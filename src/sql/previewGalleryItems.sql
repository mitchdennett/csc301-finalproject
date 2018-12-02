SELECT g.passwordprotected, g.feature_url, c.logo, DATE_FORMAT(g.date, '%M %e, %Y') as date, g.name as gallery_name, gi.* FROM gallery_items gi
JOIN galleries g on gi.galleryid=g.galleryid
JOIN final_customers c on g.customerid=c.customerid
WHERE gi.galleryid = :galleryid
ORDER BY case when sortvalue is null then 1 else 0 end, sortvalue