<?php
  /** **********************************************************
   *
   *  Smarty
   *  https://wrapbootstrap.com/theme/smarty-website-admin-rtl-WB02DSN1B
   *  documentation/php-forms.html
   *
  ********************************************************** **/
  $display_errors = true ;    // see init.php
  @date_default_timezone_set('Pacific/Auckland');
  @ini_set('memory_limit', '128M');






  /** **********************************************************
   *
   *  Email Contacts
   *  Used by contact forms
   *
   *  You can set multiple departments. 
   *  If not needed, just edit the "Wildcard" section!
   *
   *  1. Wildcard (*)
   *      if set, gets a copy all emails sent to any department!
   *
   *  2. Department
   *    gets the emails that has the destination its department.
   *
   *    Departments are set by adding a "deparment" field to HTML contact form:
   *
   *    <select name="contact_department">
   *      <option value="marketing">Marketing</option>
   *      <option value="support">Support</option>
   *      <option value="">Other</option>
   *    </select>
   *
   *    If no html department field is detected, emails are sent to * by default.
   *    There is no limit for wildcards and departments.
   *
  ********************************************************** **/
  $config['email_contacts'] = [
/*
    The email listed here MUST match the email username in the SENDERS section below otherwise we get
    errors in POSTFIX such as:

    Jun 06 07:59:02 mail postfix/smtpd[490]: NOQUEUE: reject: RCPT from unknown[192.168.1.1]: 553 5.7.1 <contact@contactnow.link>: Sender address rejected: not owned by user noreply@contactnow.link; from=<contact@contactnow.link> to=<contact@contactnow.link> proto=ESMTP helo=<contactnow.link>

*/

    [  /* [WILDCARD] OWNER / CEO / etc */
      'enabled'       => true,
      'department'    => '*',
      'name'          => 'Contact Department',
      'email'         => 'noreply@some.smtp.address'
    ],


    /* DEPARTMENTS EXAMPLES (disabled by default) */


    [ /* Marketing */
      'enabled'       => false,
      'department'    => 'marketing',
      'name'          => 'Mellissa Doe',
      'email'         => 'mellisa.doe@mydomain.com',
    ],

    [ /* Support */
      'enabled'       => false,
      'department'    => 'support',
      'name'          => 'Mellissa Doe',
      'email'         => 'support@mydomain.com',
    ],

    // ... copy/paste if more needed

  ];








  /** **********************************************************
   *
   *  @Email Providers
   *  Config used by sow_core/sow.smtp.php
   *
   *
   *  Set one or more email providers (as redundancy) to send emails.
   *  If first one fail, next one is used (and so on)... until email is sent.
   *
   *  Works with any transactional email provider: 
   *  Amazon SES, Mailgun, Sendinblue, private hosting, etc
   *
  ********************************************************** **/
  $config['sow.smtp:phpmailer_dir']       = 'sow_core/libs/phpmailer/6.0.7/';   // phpmailer path|version
  $config['sow.smtp:provider_email_list'] = [

      /* 

        1. Private Hosting
      
        Check your cPanel for valid credentials.
        Do not use your own email address.
        Create an address like 'noreply@yourdomain.com'
          so can be used only by the website to send the emails
          from sections like contact form.

      */
      [ 
        'name'      => 'Servicepod',        // Informative only
        'enabled'   => true,            // true|false

        'host'      => 'mail.servicepod.net',
        'port'      => 587,             // 25, 465 or 587
        'type'      => 'tls',           // secure type: tls or ssl (ssl is deprecated)
        'user'      => 'noreply@some.smtp.address',
        'pass'      => 'CHANGE ME!',
      ],




      /* 

        2.  Amazon SES
          https://aws.amazon.com/ses/
      

        INFORMATIVE LIMITS:
          50.000 emails / day
          14 per seconds
          $0.10 / 1000 emails
          Pay as you go
          ~$100 per 1M emails

      */
      [
        'name'      => 'Amazon SES',        // Informative only
        'enabled'   => false,             // true|false

        'host'      => 'email-smtp.eu-west-1.amazonaws.com',
        'port'      => 587,             // 25, 465 or 587
        'type'      => 'tls',           // secure type: tls or ssl (ssl is deprecated)
        'user'      => '',
        'pass'      => '',
      ],



      /* 

        Add more if needed, the same format 
        copy/paste an array above and edit.

        Transactional email providers you might like 
        (Smarty has nothing to do with them, we just used them over time for various projects)

          Amazon SES  https://aws.amazon.com/ses/
          Mailgun:    https://www.mailgun.com/
          sendinblue  https://www.sendinblue.com/
          Sendgrid    https://sendgrid.com/

      */

  ];