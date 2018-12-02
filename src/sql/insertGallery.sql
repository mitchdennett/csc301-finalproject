INSERT INTO galleries (name, date, clientid, customerid)
VALUES (:name, str_to_date(:date, '%m/%d/%Y'), :clientid, :customerid)