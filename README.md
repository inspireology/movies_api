# MonstarLab - Movies

- This API is implemented using CakePHP 4.1, MySQL 5.7 and PHP

## Implementation Overview

### General Implementation
- CakePHP was chosen because of its rapid scaffolding abilities and consistent opinionated API.
- Routing is performed in config/routes.php
  - There are 4 main endpoints specified and a 5th that is a catch-all error for any requests that do not match a defined route.
  - Each endpoint responds to the specified HTTP verb as required in the document given to me.
- API Key authentication happens in a controller extension "component" defined in src/Controllers/ApiKeyAuthorizeComponenet.php
  - It compares the API key sent with the request to see if it exists in the database.
  - Normally the keys should be salted and hashed but for the sake of this demonstration I have not done this as it makes a testing a bit more complicated.
- API Responses are handled by src/Controllers/ApiResponseComponent.php
  - These are a set of template API responses that can be called when needed to reduce duplication
  - The correct status is set and the Response object is setup with the correct data
- Database queries are handled by the CakePHP ORM
  - Custom find methods are defined in the src/Tables/MoviesTable.php and src/Tables/FavoritesTable.php to search for records.

### Database
  - The database file is located in:
  config/schema/movies/movies.sql - Database with all data
  config/schema/movies/movies_schema.sql - Database Schema Only
  - I designed the schema and used the mockaroo web application to generate mock data

  Tables:
    **actors** - actors who star in movies
    **api** - api keys and accounts
    **casts** - roles each actor has in a movie
    **directors** - directors of movies
    **favorites** - user favorites of movies
    **genres** - genres that a movie can belong to (action/romance/drama/musical...)
    **movies** - all movies
    **ratings** - age restricted ratings for movies
    **users** - users using the application (ie: a logged in customer)

The structure of the data will be more apparent when viewing the API responses

# Usage
- To use the API a valid API key must be set in the header under X-API-KEY
- This method was chosen over using a url parameter out of preference. I prefer keeping non-endpoint related data out of the url. I prefer that the URL should only specify the resource being accessed.

```bash
curl --request GET \
  --url http://localhost:8765/movie/44 \
  --header 'user-id: 1' \
  --header 'x-api-key: 8e4d4fc79980aa1e7b76fd940e5c47850574055b37dfb9f8bf90b4b0a247e58d' \
  --cookie csrfToken=c4f10b6d7900ec86f9c0a1d7c067a1de84a24c780aa319cff1d0a132
```

GET /movie/:id
View movie in detail

```json
{
	"movie": {
		"id": 1,
		"title": "Rough Magic",
		"description": "Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo. Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis. Sed ante. Vivamus tortor.",
		"duration": 13035,
		"rating_id": 4,
		"director_id": null,
		"genre_id": 4,
		"created": "2014-12-31T00:00:00+00:00",
		"modified": null,
		"favorites": [
			{
				"id": 1002,
				"user_id": 1,
				"movie_id": 1,
				"created": "2020-09-30T00:13:25+00:00",
				"modified": "2020-09-30T00:13:25+00:00",
				"user": {
					"id": 1,
					"name_first": "Dorry",
					"name_last": "Nibley",
					"email": "dnibley0@people.com.cn",
					"created": "2020-03-30T00:00:00+00:00",
					"modified": "2020-04-29T00:00:00+00:00"
				}
			},
			{
				"id": 1003,
				"user_id": 1,
				"movie_id": 1,
				"created": "2020-09-30T00:29:21+00:00",
				"modified": "2020-09-30T00:29:21+00:00",
				"user": {
					"id": 1,
					"name_first": "Dorry",
					"name_last": "Nibley",
					"email": "dnibley0@people.com.cn",
					"created": "2020-03-30T00:00:00+00:00",
					"modified": "2020-04-29T00:00:00+00:00"
				}
			}
		],
		"casts": [
			{
				"id": 62,
				"actor_id": 54,
				"movie_id": 1,
				"created": "2020-04-25T00:00:00+00:00",
				"modified": "2020-09-18T00:00:00+00:00",
				"actor": {
					"id": 54,
					"name_first": "Andromache",
					"name_last": "Di Giorgio",
					"created": "2020-09-09T00:00:00+00:00",
					"modified": null
				}
			},
			{
				"id": 186,
				"actor_id": 83,
				"movie_id": 1,
				"created": "2020-09-19T00:00:00+00:00",
				"modified": null,
				"actor": {
					"id": 83,
					"name_first": "Talya",
					"name_last": "Gason",
					"created": "2020-03-11T00:00:00+00:00",
					"modified": null
				}
			},
			{
				"id": 1544,
				"actor_id": 47,
				"movie_id": 1,
				"created": "2020-09-15T00:00:00+00:00",
				"modified": null,
				"actor": {
					"id": 47,
					"name_first": "Elisha",
					"name_last": "De Pietri",
					"created": "2020-02-16T00:00:00+00:00",
					"modified": null
				}
			},
		],
		"genre": {
			"id": 4,
			"name_display": "Comedy"
		},
		"director": null,
		"rating": {
			"id": 4,
			"name": "R",
			"description": "Restricted"
		}
	}
}

```

GET /movies?search={search}
The search string is a urlencoded json string of the following search parameters:

**title_has_words** - an array of words that can be found in the title
**description_has_words** - an array of words that can be found in the description
**rating_id** - integer values that represent the age restriction on the movie
**duration_shorter_than** - Filter by maximum length in seconds
**duration_longer_than** - Filter by minimum length in seconds

Filter movies by search
```bash
curl --request GET \
  --url 'http://localhost:8765/movies/?search=%7B%22title_has_words%22%3A%5B%22Tromeo%22%2C%22Juliet%22%5D%2C%22description_has_words%22%3A%5B%22pretium%22%2C%22iaculis%22%5D%2C%22released_after%22%3A%222000-01-01%22%2C%22duration_longer_than%22%3A30%2C%22rating_id%22%3A%201%7D' \
  --header 'user-id: 1' \
  --header 'x-api-key: 8e4d4fc79980aa1e7b76fd940e5c47850574055b37dfb9f8bf90b4b0a247e58d'
```

```json
```

GET /movies
Get popular movies
```bash
curl --request GET \
  --url http://localhost:8765/movies \
  --header 'user-id: 1' \
  --header 'x-api-key: b5395b3cf012a1e52acb83dc5791f755694e17a871e72c7a3ebda08c57ae5136'
```

```json
{
	"movies": [
		{
			"id": 46,
			"title": "Humanoids from the Deep",
			"description": "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
			"favorites_count": "17"
		},
		{
			"id": 3,
			"title": "Tromeo and Juliet",
			"description": "Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl.",
			"favorites_count": "16"
		},
		{
			"id": 73,
			"title": "Last Days Here",
			"description": "Sed accumsan felis. Ut at dolor quis odio consequat varius. Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi. Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus. Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla.",
			"favorites_count": "16"
		},
		{
			"id": 88,
			"title": "Alice Upside Down (Alice)",
			"description": "Duis at velit eu est congue elementum. In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo. Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis. Sed ante.",
			"favorites_count": "16"
		},
	]
}

```

GET /favorites
```bash
curl --request GET \
  --url http://localhost:8765/favorites \
  --header 'user-id: 1' \
  --header 'x-api-key: 8e4d4fc79980aa1e7b76fd940e5c47850574055b37dfb9f8bf90b4b0a247e58d'
```

```json
{
	"userFavorites": [
		{
			"id": 36,
			"user_id": 1,
			"movie_id": 36,
			"created": "2002-02-04T00:00:00+00:00",
			"modified": "2005-06-27T00:00:00+00:00",
			"movie": {
				"id": 36,
				"title": "Bound for Glory",
				"description": "Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros. Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat. In congue. Etiam justo. Etiam pretium iaculis justo.",
				"duration": 13596,
				"rating_id": 0,
				"director_id": null,
				"genre_id": 7,
				"created": "2016-03-18T00:00:00+00:00",
				"modified": null
			}
		},
		{
			"id": 87,
			"user_id": 1,
			"movie_id": 75,
			"created": "2018-04-05T00:00:00+00:00",
			"modified": null,
			"movie": {
				"id": 75,
				"title": "Borrowed Time",
				"description": "Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus. Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
				"duration": 14331,
				"rating_id": 2,
				"director_id": null,
				"genre_id": 9,
				"created": "2003-04-03T00:00:00+00:00",
				"modified": "2017-07-28T00:00:00+00:00"
			}
		},
		{
			"id": 146,
			"user_id": 1,
			"movie_id": 7,
			"created": "2004-06-07T00:00:00+00:00",
			"modified": "2019-02-01T00:00:00+00:00",
			"movie": {
				"id": 7,
				"title": "Funny Man, A (Dirch)",
				"description": "Aenean auctor gravida sem. Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue.",
				"duration": 8159,
				"rating_id": 5,
				"director_id": null,
				"genre_id": 7,
				"created": "2001-01-11T00:00:00+00:00",
				"modified": null
			}
		},
	]
}
```

POST /favorite/:id
Add favorite to movie of :id
```bash
curl --request POST \
  --url http://localhost:8765/favorite/1 \
  --header 'user-id: 1' \
  --header 'x-api-key: 8e4d4fc79980aa1e7b76fd940e5c47850574055b37dfb9f8bf90b4b0a247e58d'
```

```json
{
	"message": "Save was successful"
}
```
Inspecting the database shows that the favorite was added successfully.

# Assumptions
- The user is already logged in.
  - This is simulated by passing USER-ID along with the API request so that the favorite can be assigned a user_id
- This replaces needing an active session.
- CSRF is not an issue. I have disabled CSRF protection to make using simple curl requests more straightforward when you are testing.

# Testing
  - Test database
  - PHPUnit
  - Created tests

# What is missing?
- For now this is a read only API but later on in the UI development I will add writing of create and read as it will be needs
- Make error message more informative
- Far more extensive tests
- There is far more unit testing that could be done to verify that the methods behave as expected.
- Also integration testing is key

# Install
You will need to have php 7.2 and MySQL 5.7 installed.

## Configuration

Read and edit the environment specific `config/app_local.example.php` and setup the
`'Datasources'` 'default' connection to point to a database that you have created. Then import   `config/schema/movies/movies.sql` into your MySQL database. You can do the same with the 'test' connection.

In the root directory run:
```bash
composer install
```
Install config/schema/amuze_api_data.sql into your MySQL/MariaDB database and configure your connection in app_local.php
You can serve it locally with

```bash
bin/cake server -p 8765
```
This is the quickest way to run on a server. You can also run it on Apache by making it the root folder of a web directory.

After this you should be able to run the curl commands above.
