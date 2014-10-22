<?php
$global = Array(
    'loading' => "Loading ...",
    "no" => "No",
    "yes" => "Yes",
    "bottom" => "Bottom",
    "top" => "Top",
    "middle" => "Middle"
);

$loginPage = Array(
    'loginLabel' => "Login",
    'loginBtn' => "Login",
    'loginTopR' => "Login",
    'username' => "Username",
    'password' => "Password",
    'userNameReqMsg' => "The User name field is required.",
    'passReqMsg' => "The Password field is required."
);

$mainPage = Array(
    "hello" => "Hello",
    "logout" => 'Logout',
    "adminPanel" => "ADMIN PANEL",
    "companies" => "COMPANIES",
    "licenses" => "LICENSES",
    "subdistributors" => "SUB-DISTRIBUTORS",
    "distributors" => "DISTRIBUTORS",
    "icons" => "ICONS",
    "settings" => "SETTINGS",
    "content" => "CONTENT",
    "push" => "PUSH"
);

$btn = Array(
    "close" => "CLOSE",
    "save" => "SAVE",
    "create" => "CREATE",
    "delete" => "DELETE",
    "activate" => "ACTIVATE",
    "update" => "UPDATE",
    "edit" => "EDIT",
    "back" => "BACK",
    "add" => "ADD"
);

$category = Array(
    "name" => "NAME",
    "filterName" => "NAME",
    "varName" => "VARIABLE NAME",
    "varType" => "TYPE",
    "value" => "VALUE",
    "preview" => "PREVIEW",
    "addItem" => "ADD ITEM",
    "addFilter" => "ADD FILTER",
    "filters" => "FILTERS",
    "createNewCategory" => "CREATE NEW CATEGORY",
    "editCategory" => "EDIT CATEGORY",
    "createNewGraph" => "CREATE NEW GRAPH"
);

$graph = Array(
    "reportName" => "Report Name",
    "graphType" => "Graph Type",
    "sqlCommand" => "SQL Command",
    "dbName" => "DB Name",
    "backgroundColor" => "Background Color",
    "borderColor" => "Border Color",
    "borderRadius" => "Border Radius",
    "borderWidth" => "Border Width",
    "marginBottom" => "Margin Bottom",
    "marginLeft" => "Margin Left",
    "marginRight" => "Margin Right",
    "marginTop" => "Margin Top",
    "plotBackgroundColor" => "Plot Background Color",
    "plotBorderColor" => "Plot Border Color",
    "plotBorderWidth" => "Plot Border Width",
    "showAxes" => "Show Axes",
    "spacingBottom" => "Spacing Bottom",
    "spacingLeft" => "Spacing Left",
    "spacingRight" => "Spacing Right",
    "spacingTop" => "Spacing Top",
    "legendAlign" => "Legend Align",
    "center" => "Center",
    "left" => "Left",
    "right" => "Right",
    "legendBackgroundColor" => "Legend Background Color",
    "legendBorderColor" => "Legend Border Color",
    "legendBorderRadius" => "Legend Border Radius",
    "legendBorderWidth" => "Legend Border Width",
    "legendEnabled" => "Legend Enabled",
    "legendFloating" => "Legend Floating",
    "legendItemDistance" => "Legend Item Distance",
    "legendItemMarginBottom" => "Legend Item Margin Bottom",
    "legendItemMarginTop" => "Legend Item Margin Top",
    "legendLayout" => "Legend Layout",
    "horizontal" => "Horizontal",
    "vertical" => "Vertical",
    "legendLineHeight" => "Legend Line Height",
    "legendMargin" => "Legend Margin",
    "legendPadding" => "Legend Padding",
    "legendReversed" => "Legend Reversed",
    "legendShadow" => "Legend Shadow",
    "legendTitle" => "Legend Title",
    "legendVerticalAlign" => "Legend Vertical Align",
    "legendWidth" => "Legend Width",
    "legendX" => "Legend X",
    "legendY" => "Legend Y",
    "colors" => "Colors",
    "title"=> "Title",
    "subtitle" => "Subtitle",
    "xAxisLineColor" => "X Axis Line Color",
    "xAxisLineWidth" => "X Axis Line Width",
    "xAxisGridLineColor" => "X Axis Grid Line Color",
    "xAxisGridLineWidth" => "X Axis Grid Line Width",
    "yAxisLineColor" => "Y Axis Line Color",
    "yAxisLineWidth" => "Y Axis Line Width",
    "yAxisGridLineColor" => "Y Axis Grid Line Color",
    "yAxisGridLineWidth" => "Y Axis Grid Line Width",
    "enableMouseTracking" => "Enable Mouse Tracking",
    "markerEnabled" => "MarkerEnabled",
    "titleAlign" => "Title Align",
    "titleColor" => "Title Color",
    "xAxisAlign" => "X Axis Align",
    "middle" => "Middle",
    "low" => "Low",
    "high" => "High",
    "xAxisText" => "X Axis Text",
    "yAxisAlign" => "Y Axis Align",
    "yAxisText" => "Y Axis Text",
    "pieSeriesName" => "Pie Series Name"
);

$companies = Array(
    "companyName" => "COMPANY NAME",
    "login" => "LOGIN",
    "password" => "PASSWORD",
    "action" => "ACTION",
    "status" => "STATUS",
    "dbUserName" => "DB USERNAME",
    "dbPassword" => "DB PASSWORD",
    "distributorName" => "DISTRIBUTOR NAME",
    "subdistributorName" => "SUB-DISTRIBUTOR NAME",
    "createNewDistributor" => "CREATE NEW DISTRIBUTOR",
    "createNewSubdistributor" => "CREATE NEW SUB-DISTRIBUTOR"
);

$push = Array(
    "createNotification" => "CREATE NOTIFICATION",
    "notificationName" => "NOTIFICATION NAME",
    "message" => "MESSAGE",
    "dbName" => "DB NAME",
    "sql" => "SQL"
);

$licence =Array(
    "distributor" => "DISTRIBUTOR",
    "subdistributor" => "SUB-DISTRIBUTOR",
    "customer" => "CUSTOMER",
    "status" => "STATUS",
    "license" => "LICENSE",
    "createNewLicense" => "CREATE NEW LICENSE"
);
/*
$help = Array(
    "sqlHelp" => "<p><i>Line.</i> For line graph must be define column with name 'x'(for xAxis). 
                        Other column must have numbers type of data.</p>
                    <p><i>Bar.</i> For bar graph must be define column with name 'x'(for xAxis). 
                        Other column must have numbers type of data.</p>
                    <p><i>Pie.</i> For pie graph must be define column with name 'x' with names for each data line and column 'val' with numeric data. 
                        Other column must have numbers type of data.</p>
                    <p><i>Filter.</i> Filter fields must be define in scobes like '{var}', where 'var' is a filter name.
                        The value for this variable will be selected by a user from predefined list of values.</p>
                    <p><i>Example(line, bar).</i> SELECT field1 AS x, field2, field3 FROM table1 WHERE id={var1}</p>
                    <p><i>Example(pie).</i> SELECT field1 AS x, field2 AS val</p>",
    "filterHelp" => "<p><i>Filter.</i> Filter fields must be define in scobes like '{var}' of your sql string, where 'var' is a filter name.
        The value for this variable will be selected by a user from predefined list of values.</p>
    <p>Each filter has two names: "name" - will be displayed for user, "variable name" - used for sql statement.</p>
    <p>If variable has type date - user will see date spinner for selecting date</p>
    <p>If variable has type string - you must predefine list of possible items:</p>
    <p>Each item has name and value: "name" - will be displayed for user, "value" - used for sql statement</p>
    <p><i>Example</i> SELECT field1 AS x, field2, field3 FROM table1 WHERE id={var1} AND date = {var2}</p>
    <p>'var1' you defined like string and created list of possible values:</p>
    <p>"Shop1" with value "1" and "Shop2" with value "2"</p>
    <p>'var2' you defined like a date</p>
    <p>In this case user will see two filters in the mobile app:</p>
    <p>One is predefined list: "Shop1", "Shop2"; and date select</p>
    <p>If user choosed "Shop1" and date '2014-05-01 sql will look like:</p>
    <p>SELECT field1 AS x, field2, field3 FROM table1 WHERE id=1 AND date = 2014-05-01</p>"
);
 * 
 */