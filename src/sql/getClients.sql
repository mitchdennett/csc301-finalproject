/* Select customers where the customerid is equal to a passed customer id */
SELECT name, email, phone, address, city, clientid
FROM Clients
WHERE customerid = :customerid