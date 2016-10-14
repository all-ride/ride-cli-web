# Ride: Web CLI

This module adds various commands for the web environment to the Ride CLI.

## Commands

### assets deploy

This command deploys all files in the ```public``` directory of the modules and application to the web root.

**Syntax**: ```assets deploy [--watch] [<destination>]```
- ```--watch```: Time to sleep in seconds before checking again
- ```<destination>```: Path of the destination, defaults to the actual public directory

**Alias**: ```ad```

### alias

This command show an overview of the defined URL aliases.
You can add a search query to filter the result.

***Syntax***: ```alias [<query>]```
- ```<query>``` Query to search the URL aliases

**Alias**: ```a```

### alias set

This command adds a new URL alias.

**Syntax**: ```alias set <path> <alias> [<force>]```
- ```<path>```: Path of the URL from an existing route, acts as the destination of the alias
- ```<alias>```: Alias for the path
- ```<force>```: Force the alias for the provided path

**Alias**: ```as```

### alias unset

This command removes an URL alias.

**Syntax**: ```alias unset <alias>```
- ```<alias>```: Alias of the path

**Alias**: ```au```

### route

This command shows an overview of the defined routes. 
You can add a search query to filter the result.

**Syntax**: ```route [<query>]```
- ```<query>```: Query to search the routes

**Alias**: ```r```

### route set

This command adds a new route to the route definition in the application directory.

**Syntax**: ```route set <path> <controller> [<action> [<id> [<methods>]]]```
- ```<path>```: Path of the route
- ```<controller>```: Class name of the controller
- ```<action>```: Action method (indexAction)
- ```<id>```: Id for the route
- ```<methods>```: Allowed methods for the route (eg get,head)

**Alias**: ```rs```

### route unset

This command removes a route from the route definition in the application directory.

**Syntax**: ```route unset <id>```
- ```<id>```: Id of the route

**Alias**: ```ru```

### router

This command performs a routing action for the provided path.

**Syntax**: ```router [<path> [<method>]]```
- ```<path>```: Path to route
- ```<method>```: Method of the request

**Alias**: ```rr```

### session clean

This session cleans up the invalidated sessions.

**Syntax**: ```session clean [--force]```
- ```--force```: To clear all sessions

**Alias**: ```sc```

## Related Modules 

- [ride/app](https://github.com/all-ride/ride-app)
- [ride/cli](https://github.com/all-ride/ride-cli)
- [ride/lib-cli](https://github.com/all-ride/ride-lib-cli)
- [ride/lib-http](https://github.com/all-ride/ride-lib-http)
- [ride/lib-router](https://github.com/all-ride/ride-lib-router)
- [ride/lib-system](https://github.com/all-ride/ride-lib-system)
- [ride/web](https://github.com/all-ride/ride-web)

## Installation

You can use [Composer](http://getcomposer.org) to install this application.

```
composer require ride/cli-web
```
