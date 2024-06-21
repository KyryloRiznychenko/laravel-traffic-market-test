<h4>How to run?</h4>

1) Run the **docker-compose up [--force-recreate]** command in the project directory.
2) After the end of the building, run the **docker exec -ti test-php-fpm sh** command for dives into the app container.
3) If you catch a 502 error, you need to wait a bit while the entrypoint script completes its run.

<h4>Available routes are:</h4>

1) GET - http://localhost/api/news
2) GET - http://localhost/api/news/{entityIdOrSlug}
3) PATCH - http://localhost/api/news/{entityIdOrSlug}/status