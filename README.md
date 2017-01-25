# Download and Install
From console just type the commands: 
    
    git clone git://github.com/Overflow012/retrieve_user_profile.git
    cd retrieve_user_profile
    composer install

# Set up
You will need a facebook `app_id` and `app_secret`.

# Run the app
    cd public
    php -S 0.0.0.0:8888

# Using App
You will need a user token. For testing purposes you can get a user token from https://developers.facebook.com/tools/accesstoken/

    curl --header "token:<YOUR_USER_TOKEN>" http://0.0.0.0:8888/api/profile/facebook/me

You can use and user facebook id instead of `/me`

# Thanks
Thank you for the opportunity :).
