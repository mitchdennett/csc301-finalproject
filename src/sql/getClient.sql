/* Select customers where the customerid is equal to a passed customer id */
SELECT *
FROM Clients
WHERE clientid = :clientid AND customerid = :customerid