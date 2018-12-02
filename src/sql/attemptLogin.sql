/* Select customers where the username and password match those passed as parameters */
SELECT *
FROM final_customers
WHERE
	username = :username AND
	password = :password
	