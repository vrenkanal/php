<?php

// Production environment
$PagSeguroResources['environment'] = array();
$PagSeguroResources['environment']['production']['webserviceUrl'] = "https://ws.pagseguro.uol.com.br";
$PagSeguroResources['environment']['sandbox']['webserviceUrl'] = "https://ws.sandbox.pagseguro.uol.com.br";

// Payment service
$PagSeguroResources['paymentService'] = array();
$PagSeguroResources['paymentService']['servicePath'] = "/v2/checkout";
$PagSeguroResources['paymentService']['checkoutUrl'] = "/v2/checkout/payment.html";
$PagSeguroResources['paymentService']['webserviceUrl']['production'] = "https://pagseguro.uol.com.br";
$PagSeguroResources['paymentService']['webserviceUrl']['sandbox'] = "https://sandbox.pagseguro.uol.com.br";
$PagSeguroResources['paymentService']['serviceTimeout'] = 20;

// Notification service
$PagSeguroResources['notificationService'] = array();
$PagSeguroResources['notificationService']['servicePath'] = "/v2/transactions/notifications";
$PagSeguroResources['notificationService']['serviceTimeout'] = 20;

// Transaction search service
$PagSeguroResources['transactionSearchService'] = array();
$PagSeguroResources['transactionSearchService']['servicePath'] = "/v2/transactions";
$PagSeguroResources['transactionSearchService']['serviceTimeout'] = 20;
