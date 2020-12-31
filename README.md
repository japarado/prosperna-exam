# Prosperna Exam

This project is my first attempt in integrating PayPal in Laravel's registration process

![alt_text](https://res.cloudinary.com/dkxsudplj/image/upload/v1609339764/prosperna-exam/prosperna-exam-registration-screen_ritxp8.png "Registration Page")

## About

I tried patterning the database the way that Laravel Cashier and Stripe does it with a dedicated table for holding
subscription information. 

I personally think that this method is far from being a "best practice". Information regarding "good" PayPal integration is extremely sparse
and online searches usually yield wrapper libraries for making REST API calls. I plan to update this repository in the future
when I learn more so that I can use it as a template.

## Additional Notes

### Debug Tools

1. Delete all users by navigating to /login and clicking on the "FOR DEBUGGING - DELETE ALL USERS BUTTON" 

![alt_text](https://res.cloudinary.com/dkxsudplj/image/upload/v1609339766/prosperna-exam/prosperna-exam-login-page_pjdtqd.png "Login Page")

### TODOs

1. Improvements to PayPal-related migrations
	1. It is highly likely that the migrations do not follow "industry practices" or "best practices". Help or material regarding this would be greatly appreciated.
2. Known Bugs
	1. The registration screen shows PayPal-related errors when submitting invalid user info
	![alt_text](https://res.cloudinary.com/dkxsudplj/image/upload/v1609340034/prosperna-exam/prosperna-exam-registration-error_rdpnjy.png "Registration page error")
3. Additional Work
	1. Add middleware to check subscription data for every request 
4. Webhooks or a CRON job to check subscription status every day
