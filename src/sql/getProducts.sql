SELECT d.detailid, d.detail_description, d.suggested_price, p.productid, p.product_description, c.categoryid, c.description FROM products_details d
  JOIN products p ON d.productid = p.productid
  JOIN product_categories c on c.categoryid=p.categoryid;
