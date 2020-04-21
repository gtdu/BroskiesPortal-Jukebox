# Broskies Portal Module [TEMPLATE]

This is a template repository for creating a module to integrate with the GTDU broskies portal.

## Authentication Flow
Once you have been given your API key by a system admin, simply paste it into the provided script. The flow for how the portal interacts with your module goes like this:
  1. User clicks the link to visit your module
  2. The portal loads your module in an iFrame
  3. The iFrame is pointed at the `root_url` that you provided when requesting the api key
  4. A `GET` parameter called `session_token` is passed to the `root_url`
  5. Using the API key and Session Token, you can query the portal to get basic user information
    - Name
    - Email
    - Level _(see Permissions)_
    
## Permissions
Every module has an associated `level` attribute managed by portal system administrators. It is an integer > 0 that you can interpret to fit the needs of your application.

The recommended values are:
  - `0` = No Access
  - `1` = Default Access
  - `2+` = Advanced Privileges
  
All users will start with a value of 1 for your module so treat this as the default level of access. 
It also makes sense for the largest value to correspond to the most rights (system owner/admin)
