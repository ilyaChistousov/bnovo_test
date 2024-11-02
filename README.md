## Guest microservice

### Description
Микросервис для работы с гостями 

### Installation

```
docker-compose up -d
```

### API

Get all guests

```
GET /api/guest
```

Get guest by id

```
GET /api/guest/{id}
```

Create guest

```
POST /api/guest
{
  "name": "name",
  "surname": "surname",
  "phone": "+78005553535",
  "email": "test@test.com",
  "country": "Russia"
}
```

Update guest
```
PUT /api/guest/{id}
{
  "name": "new_name",
  "surname": "new_surname",
  "phone": "+78005553535",
  "email": "test@test.com",
  "country": "Russia"
}
```

Delete guest
```
DELETE /api/guest/{id}
```

### Response headers

All response have headers X-Debug-Time and X-Debug-Memory
