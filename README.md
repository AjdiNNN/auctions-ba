## CEN 308 - Software Enginerring: Configuration Management, Deployment and Versioning

This is a demo project made for the purposes of demonstrating deployment, CI/CD and versioning for the CEN 308 course.

In this release, the following features are available:
####  VPS deploy of [WEBSITE](https://keytrackedu.com/auctions-ba/ "WEBSITE") 
##### REST API routes also available on [OPENAPI documentation page](https://keytrackedu.com/auctions-ba/rest/docs/ "OPENAPI")
		1. GET /users
		2. GET /users/{id}
		3. POST /users
		4. PUT /users/{id}
		5. DELETE /users/{id}
		6. GET /items
		7. GET /items/{id}
		8. POST /items
		9. PUT /items/{id}
		10. DELETE /items/{id}
		11. GET /bids/{id}
		12. POST /bids
		13. PUT /bids/{id}
		14. DELETE /bids/{id}
		15. POST /login
		16. POST /register
		17. GET /user
##### Authorization done by JWT token authorization
#### **PHPUnit tests**
**testRegisterUserEmail**: This test verifies the registration process by attempting to register a user with an already registered email address. It expects a response with a status code of 500 and the message "Email already registered."

**testRegisterUserUserName**: This test checks the registration process by attempting to register a user with an already taken username. It expects a response with a status code of 500 and the message "Username already registered."

**testLoginUser**: This test validates the login functionality by attempting to log in with an email address that does not exist in the system. It expects a response with a status code of 404 and the message "User doesn't exist."

**testLoginWrongPasswordUser**: This test ensures that the login process rejects incorrect passwords by attempting to log in with a valid email address but an incorrect password. It expects a response with a status code of 404 and the message "Wrong password."

**testLoginTrueUser**: This test verifies the successful login process by attempting to log in with a valid email address and password. It expects a response with a status code of 200 and a token in the response data.



####CODING STANDARDS
[![JavaScript Style Guide](https://cdn.rawgit.com/standard/standard/master/badge.svg)](https://github.com/standard/standard)
###PSR-12
###Patterns used
1. Singleton Pattern: The Config class in index.php is implemented as a Singleton pattern. It ensures that only one instance of the Config class is created and provides a global point of access to the configuration settings throughout the project.

3. Factory Method Pattern: The Flight class in index.php acts as a Factory Method pattern. It creates instances of various classes such as UserService, ItemService, BidService, and UserDao, which are used throughout the application.

5. Dependency Injection: The Flight class in index.php demonstrates the use of Dependency Injection by creating instances of services and injecting them into routes. For example, UserService, ItemService, and BidService instances are injected into various routes to handle user-related, item-related, and bid-related functionality, respectively.

7. Data Access Object (DAO) Pattern: The UserDao class in dao.php represents the Data Access Object pattern. It provides methods for interacting with the underlying database and encapsulates the database operations related to the users table.

9. Service Layer Pattern: The UserService, ItemService, and BidService classes in services.php act as service classes, implementing the Service Layer pattern. They provide higher-level, domain-specific functionality and encapsulate the business logic for user-related, item-related, and bid-related operations, respectively.

11. Builder Pattern: The Flight::json() method used in various routes, such as POST /register, POST /login, POST /item, DELETE /item/{id}, etc., can be considered as an implementation of the Builder pattern. It constructs and returns JSON responses using a fluent interface, allowing flexibility in building the response object.

13. Front Controller Pattern: The index.php file serves as the entry point and acts as a Front Controller for the application. It receives all requests, initializes the necessary components, handles routing, and dispatches requests to appropriate routes.
---
> Ajdin Hukić, Amina Kodžaga 
> 
> Course Software Engineering
> 
> *2023 © International Burch University*
