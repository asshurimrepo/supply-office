<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-cosmo.css" rel="stylesheet">
<style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

    </style>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">    
</head>

<body>
<div class="container">


      <div class="jumbotron">
        <h1><?php echo $title; ?>!</h1>
        <p class="lead">Stock Manager Advance (Invoice & Inventory System) is php based web application that help you to manage your stock. Add products, purchase and sales from anywhere, Office, Home, Warehouse or on the go.</p>
        <a class="btn btn-large btn-success" href="index.php?module=installer&view=setup&step=1">Launch Installer</a>
      </div>

      <div class="row-fluid well">
        <div class="span6">
          <h3>Products</h3>
          <p>Manage Unlimited Products and Categories with Product quantity tracking.</p>

          <h3>Sales</h3>
          <p>Generate Quotations, Add Sales, Generate Sales from Quotations, Manage Damage Products and much more.</p>

          <h3>Purchases</h3>
          <p>Built-in Inventory System to manage your stock and option to Add Inventory by CSV file for bulk products.</p>
        </div>

        <div class="span6">
        <h3>Settings</h3>
          <p>Setup Stock Manage with few clicks, It's been never that easy to manage a web app.</p>
          
          <h3>Warehouse</h3>
          <p>Manage Multiple Warehouses with products stock, Sales, Purchases and Stock Value by Buying Cost and Selling Price.</p>

          <h3>Reports</h3>
          <p>Advance Reports for Sales/Purchase, Product Alert, Stock Overview, Stock Value for each warehouse and  much more.</p>
          
        </div>
      </div>

      <div class="footer">
        <p class="text-center">&copy; 2013 Tecdiary IT Solutions</p>
      </div>

    </div> 
</body>
</html>
