# Enum

Library for enumerate objects

## Simple use

### Create enum class with constants:

```php
class MyEnum extends Enum {
    const CONSTANT_A = 'value_a';
    const CONSTANT_B = 'value_b';
}
```

### Use it as object or as scalar:

```php
$enumObject = MyEnum::getInstance(MyEnum::CONSTANT_A);
echo $enumObject->getValue(); // prints 'value_a'
echo $enumObject;             // also prints 'value_a'
```

### Validate enum by passing whole object instead of scalar:

```php
function someFunction(MyEnum $enumObject): void
{
    // ...
}

$enumObject = MyEnum::getInstance(MyEnum::CONSTANT_A);
someFunction($enumObject);
```

### Compare instances:

```php
function compareFunction(MyEnum $firstEnumObject, MyEnum $secondEnumObject): bool
{
    return $firstEnumObject === $secondEnumObject       // both variants
        || $firstEnumObject->equals($secondEnumObject)  // are identical
}
```

## Get enum instances via magic static call

```php
/**
 * @method static self valueA()
 * @method static self valueB()
 */
class MyEnum extends Enum {
    use MagicStaticCallEnum; // use MagicStaticCallEnum trait

    const CONSTANT_A = 'value_a';
    const CONSTANT_B = 'value_b';
}

$enumObject = MyEnum::valueA(); // instead of MyEnum::getInstance(MyEnum::CONSTANT_A)
```