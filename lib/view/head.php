<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, minimum-scale=1">

<meta property="og:title" content="<?php echo $Vars->Name ;?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $Link->Website ;?>" />
<meta property="og:image" content="<?php echo $Link->Website . "img/logo.png" ;?>" />
<meta property="og:description" content="<?php echo $Vars->Description; ?>" />

<meta name="description" content="<?php echo $Vars->Description; ?>">
<meta name="keywords" content="<?php echo $Vars->Keywords; ?>">
<meta name="author" content="Tiago Severino">

<title><?php echo $Vars->FriendlyURL ;?></title>

<!-- Icon -->
<link rel="shortcut icon" type="image/png" href="<?php echo $Link->Website . "img/icon.png" ;?>"/>

<!-- Font Ubuntu Mono -->
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">

<!-- Include Font Awesome Stylesheet in Header -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Stylesheet -->
<link rel="stylesheet" href="<?php echo $Link->Website . "css/styles.css" ;?>">