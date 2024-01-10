<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify - Your Destination for Fabilous Shopping</title>
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <!-------------External Links------------------>
    <meta name="robots" content="NOINDEX,NOFOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
   
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/static/frontend/Mgs/molla/en_US/mage/calendar.css">
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/static/frontend/Mgs/molla/en_US/css/styles-m.css">
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/static/frontend/Mgs/molla/en_US/MGS_ExtraGallery/css/style.css">
    
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/static/frontend/Mgs/molla/en_US/MGS_Fbuilder/css/pbanner.css">
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/static/frontend/Mgs/molla/en_US/MGS_Fbuilder/css/styles.css">
        <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/media/mgs/fbuilder/css/blocks.min.css">
    <link rel="stylesheet" type="text/css" media="all"
        href="https://molla.arrowtheme.com/media/mgs/fbuilder/css/10/fbuilder_config.min.css">


    <link rel="stylesheet" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css','resources/js/script.js'])
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>