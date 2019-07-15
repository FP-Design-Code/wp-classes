# Floating-Point WordPress Classes

## Table of Contents

* [Config](#config)
    * [get](#get)
    * [getValue](#getvalue)
* [Field](#field)
    * [__construct](#__construct)
    * [register](#register)
* [Loader](#loader)
    * [__construct](#__construct-1)
    * [add_action](#add_action)
    * [add_filter](#add_filter)
    * [run](#run)
* [Value](#value)
    * [get](#get-1)
    * [update](#update)
    * [add](#add)
    * [delete](#delete)

## Config

Get the config of the plugin

Before using you must define a constant for FP_CONFIG_FILE
which contains the configuration values.

* Full name: \FloatingPoint\Wp\Config


### get

Get the config

```php
Config::get(  )
```



* This method is **static**.



---

### getValue

Get a value from Config array

```php
Config::getValue(  $key ): mixed
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **** | The key in the array |


**Return Value:**

The value from the array



---

## Field

Register a meta field for use in Block editor



* Full name: \FloatingPoint\Wp\Meta\Field


### __construct

Initialize the class and set its properties.

```php
Field::__construct(  $key,  $args = array() )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **** |  |
| `$args` | **** |  |




---

### register

Register the Meta

```php
Field::register(  )
```







---

## Loader

Register all actions and filters for the plugin

Maintain a list of all hooks that are registered throughout
the plugin, and register them with the WordPress API. Call the
run function to execute the list of actions and filters.

* Full name: \FloatingPoint\Wp\Loader


### __construct

Initialize the collections used to maintain the actions and filters.

```php
Loader::__construct(  )
```







---

### add_action

Add a new action to the collection to be registered with WordPress.

```php
Loader::add_action( string $hook, object $component, string $callback, integer $priority = 10, integer $accepted_args = 1 )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$hook` | **string** | The name of the WordPress action that is being registered. |
| `$component` | **object** | A reference to the instance of the object on which the action is defined. |
| `$callback` | **string** | The name of the function definition on the $component. |
| `$priority` | **integer** | Optional. he priority at which the function should be fired. Default is 10. |
| `$accepted_args` | **integer** | Optional. The number of arguments that should be passed to the $callback. Default is 1. |




---

### add_filter

Add a new filter to the collection to be registered with WordPress.

```php
Loader::add_filter( string $hook, object $component, string $callback, integer $priority = 10, integer $accepted_args = 1 )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$hook` | **string** | The name of the WordPress filter that is being registered. |
| `$component` | **object** | A reference to the instance of the object on which the filter is defined. |
| `$callback` | **string** | The name of the function definition on the $component. |
| `$priority` | **integer** | Optional. he priority at which the function should be fired. Default is 10. |
| `$accepted_args` | **integer** | Optional. The number of arguments that should be passed to the $callback. Default is 1 |




---

### run

Register the filters and actions with WordPress.

```php
Loader::run(  )
```







---

## Value

Utitlies to retirve and store meta values



* Full name: \FloatingPoint\Wp\Meta\Value


### get

Get the meta value

```php
Value::get(  $id,  $field,  $single = true )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$field` | **** |  |
| `$single` | **** |  |




---

### update

Update and exisiting meta value

```php
Value::update(  $id,  $field,  $value )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$field` | **** |  |
| `$value` | **** |  |




---

### add

Update an exisiting meta value

```php
Value::add(  $id,  $field,  $value )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$field` | **** |  |
| `$value` | **** |  |




---

### delete

Delete an exisiting meta value

```php
Value::delete(  $id,  $field,  $value )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |
| `$field` | **** |  |
| `$value` | **** |  |




---



--------
> This document was automatically generated from source code comments on 2019-07-15 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
