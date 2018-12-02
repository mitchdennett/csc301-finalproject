UPDATE clients
SET email = :email, phone = :phone, address = :address, city = :city
WHERE clientid = :clientid AND customerid = :customerid
