## CEN 308 - Software Enginerring: Configuration Management, Deployment and Versioning

This is a demo project made for the purposes of demonstrating deployment, CI/CD and versioning for the CEN 308 course.

In this release, the following features are available:
- JWT token authorization
- the `POST /register` endpoint
- the `POST /login` endpoint
- the `GET /bids/@id` endpoint 
- the `POST /bid` endpoint
- the `GET /items` endpoint 
- the `GET /items` endpoint 
- the `GET /items/@id` endpoint 
- the `GET /useritems` endpoint 
- the `POST /item` endpoint 
- the `DELETE /item/@id` endpoint 

- Swagger documentation set up but it is not working on vercel deployment, due to vercel serverless functions not exposing routes directly via directories.

- Note currently there is no database, so api calls won`t return anything, except SQL error. Database will be also hosted in upcomming days.

- Also there is angular set up made for our frontend which will be done in upcomming weeks.

---
> Ajdin Hukić, Amina Kodžaga 
> 
> Course Software Engineering
> 
> *2023 © International Burch University*
