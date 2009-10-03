ShadowBox Theme

ShadowBox is WordPress theme that allows blog owners to choose various theme "options" to customize the appearance and layout of the ShadowBox theme.  

New ShadowBox variations
WordPress users who have access to theme files can make their own variations of ShadowBox theme.  

Image Variations
Put images for your variation in a subfolder in the images directory and access them using the $options['background'] variable in the functions.php file (e.g. $options['background'] = <<subfolder_name>>)

Variation Options
To display new variations to users, add them to the form in the shadowbox_options function. Update set_variation_option() with the default options and option value choses you would like to use in your theme. As well, update set_derivative_options function to set derivative options based on the primary options defined in the shadowbox_options function.

Here are various ways to extending this theme.

Background Colors
New background colors can be added to $options['background'].  A given background color can then be used to set a number of other options including:
$options['background_color']$options['bgtextcolor']$options['bglinkcolor']$options['bgbordercolor']

The drop shadow used for most background colors is a .png file with a transparent background.  This generally works for most background colors except black (which has its own set of images).  Store these images in $options['page_image_directory'] and use $options['background_image_file'] to reference them.   

Background Images
Background images can be used with this theme as well and are also stored in $options['background_image_directory'].  Currently "Gray-White", "White-Gray", "Yellow-White", "White-Yellow", "Blue" and "Green" all use background images.  It is a good practice to set the background color to be something that approximates the dominant color of the background image.

Use the $options['background_repeat'] to set the background-repeat, $options['background_position'] to set background-position and $options['background_color'] to set background_color.

Header Colors
New header colors can also be created with $options['headercolor']. Based on the header color, the following options can be applied:
$options['headertext']$options['headerdescription']$options['headerborder']$options['headertop']$options['headerbottom']

Sidebar Colors
New sidebar colors can also be created with $options['headercolor'].  Based on the sidebar color, the following options can be applied:
$options['sidebar-right-border-right']$options['sidebar-right-border-bottom']$options['sidebar-right-border-left']
$options['sidebar-left-border-right']$options['sidebar-left-border-bottom']$options['sidebar-left-border-left']

