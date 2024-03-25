# hotpot-booking-system

## General Pages - USER
### Index.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/1a8966fb-26a5-47ed-90bc-8c182582435e)

Figure 2: Home Page  

The home page in Shabu-now offers a wide range of images with a deep red colour to help user visualise how the hotpot experience will be like. This includes a navigation at the header where users can return to home page, skip to the menu section or log into their account. User can hover over the pictures of the packages to get more information regarding the packages. Alternatively, users can also scroll down without accessing the menu navigation to see the packages. The packages are all displayed in the home page to reduce the need to go to another page. A footer is included where information such as opening time and contact information are included. 

### Userlogin.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/7e6b8a16-2c3b-41af-8cc3-d07836cc7677)

Figure 3: Login Page  

The login page includes the header as well as the footer to maintain consistency. Users would have to key in their email and password to login. They also have the option to click on remember me so that their next session will be stored. In the case where users do not have an account, they can register for an account. In the case where users forgot their password, they can opt to change their password. 

 
### Register.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/a5955d11-bf9e-4203-9b77-302df54cf31b)

Figure 4: Register Page   

User would need to input their name, email, password and phone number to register. They would also need to validate their password. Their password would also need to be at least 8 letters long with at least 3 digits and 1 symbol. The registered password would be saved in hash as a form of security. Users would have to agree to the terms and condition and fill in every input box in the form before registering. In the case where the users already has an account, they can opt to login. 

 
### newpassword.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/c3bf9425-09ed-4a3f-a4a3-70bab0a7bc9d)

Figure 5: Forget Password Page   

If the user chose forgot password during login, they will be redirected to set new password. The prerequisite to set a new password is to input the email address corresponding to the user’s account.  

### booking_main.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/aaf6463c-3682-4dba-b915-3926a2b08f90)

Figure 6: Booking Page    

Users will only be allowed to book after they log in. The booking page consists of a form that requires information such as name, package option, pax, date, time and payment type. The information inputted will be simultaneously displayed on the right side as confirmation. The information given will be saved into the booking table in the database along with the registered email address. Users are not allowed to leave any input area blank. User will not be allowed to add more pax than the allocated amount of people for each package. User will be required to book a separate package and liase with the employees during their visit. Payment type will determine which page the user will be redirected to after submitting the booking. If the user chose to pay with e-wallet, then they will be redirected to the e-wallet redirection page, if they chose to pay with card then they will be redirected to the payment page. In the case they chose to pay later physically, they will be redirected back to the home page.  

### payment.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/e7ff619b-eda0-4d8f-bb2a-18c4e97b12b6)

Figure 7: Payment Page       

The payment page displays the previous information entered in the booking form as well as a payment form that includes card number, card expiry date, security code and cardholder name. The card information will not be saved; however, payment subtotal and payment type will be saved along with receipt number. The card number will need to be exactly 16 digits long to be able to submit the payment.  

### payment-ewallet.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/60593003-c670-43a5-a8e2-e9520ce1952a)
 
Figure 8: E-wallet redirection page    

This page is simply for demonstration purposes before the website is to be redirected to the e-wallet payment application. Users can view their receipts after payment is done. 
 
### receipt.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/94a1f1f5-003c-404d-bd06-3c7ed5a88e29)
 
Figure 9: Receipt Page            

In the receipt, user can refer to all their inputted information and their booking time and date as well as the amount they have paid. Users can click on done after going through the receipt and they will be redirected back to the user home page. 

### booking_history_user.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/b4819c14-68cd-437d-8216-562e586374c1)

Figure 10: User Booking History         

Users can check their boooking history through the history navigation tab on the header. A table will display with booking reference number, receipt number, customer email, package name, pax, data and time, completion, and a cancellation function. The cancellation function will allow the users to cancel their booking. The cancellation function will delete the booking from the system. 
 
### account.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/5bd03ed6-c7b0-479b-a17a-fcb2ee331848)
 
Figure 11: User Account Information    

User Account Information page displays the user’s full give name in the system, email, phone number and intentionally left password blank as a security measure. Users can opt to change their account information using the change button and opt to log out using the log out button. Change button will redirect the user to a different page while the log out button will destroy the session and redirects back to the home page.  

### changeaccount.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/247fc35c-dc5f-48a2-9b9b-980d48b89218)

Figure 12: Update Account Information Page    

Users are allowed to change their name, phone number and password but not email. Password is needed to be either re-entered or change when other information is changed due to it being hashed. Once the user confirms the entered information, they can click save and they will be redirected back to the account information page. 



	 
## General Pages – ADMIN
### adminlogin.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/24e50c3d-9be2-4a32-a328-c0e9d0e98eed)
 
Figure 13: Admin Login Page     

Admin are required to log in with their email address and password as well as having an option to remember their login. In the case that they don’t have an account, they can click on “Register Now” and will be redirected to the register page. In the case that they forgot their password, they can click on change it here and be redirected to another page to change their password. 

### adminregister.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/b22efc56-144b-448c-a8d9-e1b3f12810ad)

Figure 14: Admin Registration Page    

Admin would have to register with their name, email and a password. The password would have to be at least 8 letters long with 3 digits and 1 symbol. The password will also be validated, and users would have to confirm their password. The password would appear as a hash in the database as a security measure. The same admin cannot register with the same email address twice as one admin is only allowed one account. Admin would have to agree with the terms and conditions before registering. In the case that they already have an account, they can opt to log in as well.  

### newadminpassword.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/b66a634c-441e-4081-b152-54f8b7cf801f)

Figure 19: Admin Forget Password Page    

When the admin clicks forget password, they will be redirected to this page where they will be required to enter their respective email address corresponding to their account and put in their new password. They will also be required to validate the password by re-entering it as confirmation. 

### adminaccount.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/f28fb11b-f45e-401e-929b-b23be894a69b)

Figure 15: Admin Account Information Page    

In this page, the admin’s registered information such as full name, email will be shown while password would be intentionally left blank as it is saved in hash. If the users pressed the change button, they will be redirected to the change admin account information page. If the users press logout, the session will end, and they would be redirected to the login page again. 

### admin_changeaccount.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/5ef6ff3f-b65f-49bc-8d7a-e82e0fbe6faf)

Figure 16: Update Account Information Page     

In this page, admins are allowed to change their name and password, however, they are not allowed to change their email address as each account has only one unique email address and each email address can only have one account. They would be required to either enter their original password or enter a new password and the password is intentionally left blank due to it being hashed. 
 
### admin_display.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/6e30603a-d6e2-4bae-87c3-1c283db1ede5)

Figure 17: Admin Main Function Page      

To access this page, admin will first have to log into their account, if they are not logged in, they will be redirected to the login page. Admin can view all the packages that Shabu-now is currently offering, and all the booking. Admin can choose the delete a menu and it will disappear from the database and the user’s interface. Admin can also click on add menu and be redirected to a form to input new information regarding the new menu. In terms of booking, admin is alowed to change the completed status of the booking from yes to no and no to yes, and this will be reflected on the user’s booking history. Admin will only mark the completed status as yes after the customers has paid and completed their dining appointment. Admin can also delete a booking which will also automatically delete on the user’ side. This is only done, when a booking is cancelled, and the user can refer through their booking history. 
 
### admin_add.php
![image](https://github.com/calmserenity/hotpot-booking-system/assets/142383855/7a3e7e40-13ad-4738-9e7d-d0f694d22380)
 
Figure 18: Add New Menu Page          

Once redirected to the add menu page, admin will need to fill in the package name, pax, food, room availability and price. This will be inserted into the menu table and will be reflected on to the user’s side. The new menu will then join as a new row in the admin menu table display. When users make a booking, the maximum people that they can input will depend on the pax of the menu entered here.  







