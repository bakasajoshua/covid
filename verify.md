FORMAT: 1A

# Verify

# Login

## Login as a user. [POST /auth/login]
Middleware Guest

Use the token to authorise your other requests

Pass the token in a header

Authorization: bearer {token}

+ Request (application/json)
    + Body

            {
                "email": "email",
                "password": "string"
            }

+ Response 200 (application/json)
    + Body

            {
                "status": "ok",
                "token": "token",
                "expires_in": "ttl in minutes"
            }

+ Response 403 (application/json)
    + Body

            {
                "status_code": 403,
                "message": "403 Forbidden"
            }

# AppApiV1ControllersVerifySampleController

## Display the specified resource. [GET /verify/{id}]
Authorization: bearer {token}

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "status": "ok",
                "identifier": "ID / Passport Number ",
                "name": "patient name",
                "area_of_residence": "residence",
                "date_tested": "YYYY-MM-DD",
                "lab": "lab that was tested",
                "result": "Positive / Negative"
            }

+ Response 401 (application/json)
    + Body

            {
                "message": "Token has expired",
                "status_code": 401
            }

+ Response 404 (application/json)
    + Body

            {
                "status_code": 404
            }


# AppApiV1ControllersVerifySampleController

## Display the specified resource. [POST /credential_request]

+ Request (application/json)
    + Body

            {
                "email": "email",
                "name": "string, name of person making a request",
                "organisation": "string, name of organisation of the requester",
                "phone_number": "string, phone number of person making a request",
                "details": "string, a statement stating why the requester needs access",
            }

