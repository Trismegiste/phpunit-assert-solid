# SOLID Assertions for [PHPUnit][1]
Don't remind others the [SOLID][3] guidances, do it programatically... with an axe :smile:

[![Build Status](https://travis-ci.org/Trismegiste/phpunit-assert-solid.svg?branch=master)](https://travis-ci.org/Trismegiste/phpunit-assert-solid)

## When

Today is the day your programer's life has changed ! You're tired to endlessly remind
your team/github-users to follow [SOLID principles][3] and [Demeter's Law][2] ? Now it's over.
(With such a statement, I wage you'll read the next paragraph)

## What

It's a library of assertions for the programer's best friend a.k.a : [PHPUnit][1].
These **assertions** are about how **classes** don't break some elementary rules of OOP, 
mainly the **SOLID guidances** and Demeter's Law.

## How

This library does nothing by itself. It is NOT a static code analyzer,
it is more a helper for putting assertions
on SOLID compliance in unit tests. If a static code analyzer is a cure, this tool is
a vaccine.

### Add this lib to your project with [composer][5] :
```bash
 $ composer.phar require --dev trismegiste/phpunit-assert-solid:dev-master
```

### use the trait in your phpunit unit test class :
```php
class ProjectTest extends PHPUnit_Framework_TestCase
{
    use \Trismegiste\SolidAssert\GoodPractice;  // <= this adds my new assertions
// see examples/SimpleTest.php for a running example or below...
```

## Why

Well, no one can force you to launch an analyzer unless some pre-commit 
hooks are set. Futhermore, even best analyzer cannot detect minor 
problem (specially with soft-typed language like PHP). Sometime those analyzers
detect false negative so you could reasonably not put strict assertions based 
on those analyzers metrics.

Besides, in reality no one need a strict SOLID compliance for the whole project.
Sometime, you break a rule because
of speed/memory optimization. Sometime you break a rule because you don't
want to over-engineer objects (which is bad practice too). 
Sometime you want to be very strict on THIS class 
and sometime you don't care about that quick & dirty package.

This tool is made for that.

## Where

In the unit tests. So you're sure some simple assertions are checked. 
Except this lib, no other tools are required. Example,
you made a beautiful loose-coupled class with all methods parameters type-hinted
with interfaces : add to your phpunit tests for this class 
`$this->assertInterfaceHintedParameter('MessyProject\MyBeautifulClass');`

## Who

YOU ! You decide how, how much and when one of your class must
follow SOLID guidances. It does not cover all guidances but those assertions
detect recurrent anti-patterns which could appear after many commits
from others until you discover it is too late. 

Isn't it great to know now your classes will keep their "design intent" even in
chaotic environments ?

## Examples Please !

```php
class SimpleTest extends PHPUnit_Framework_TestCase
{
    use \Trismegiste\SolidAssert\GoodPractice;  // inserts new assertions

    public function testConcreteTypeHint()
    {
        // this one tests for loose-coupling :
        $this->assertInterfaceHintedParameter('BadProject\Case1');
    }

    public function testHollywoodPrinciple()
    {
        // this one for Hollywood Principle :
        $this->assertHollywoodPrinciple('BadProject\Case4');
    }
    
    // ...
}
```
see full example in ./examples/SimpleTest.php

## API
In all assertions, $fqcn means "fully qualified class name" as described as in PSR-0

### assertTypeHintedMethodReturn($fqcn)
Asserts if all methods of a given class have a return type

### assertInterfaceHintedParameter($fqcn)
Asserts if all methods parameters for a given class/interface are type-hinted with interface
and not class. (loose-coupling)

### assertNoMethodWithoutContract($fqcn)
Asserts if all public methods for a given class are first declared in an interface
implemented by this class. (design by contract and ISP)

### assertSmallApi($fqcn, $size)
Asserts if a given class has a small public api. Too many methods means too many
responsibilities (SRP). Default size is 5

### assertHollywoodPrinciple($fqcn)
Asserts there is no "new" nor Singleton calls in a given class. This ensures
object dependencies are injected in this class, not created nor requested (DIP).
A variant is "don't ask, tell".

### assertLiskovCompliant($fqcn) 
Asserts there is no "reflection tricks" which would undermine LSP : is_subclass_of,
instanceof, method_exists and class_uses. There is exception for interfaces
because, it is less dangerous and a common pattern.

### assertNotStaticFactory($fqcn)
Asserts there is no new in a static method (typically singletons and static factories
are use-case) because it is a violation of OCP (and DIP as edge-effect). Standard
creational design patterns (Factory Method, Builder...) are not targeted by this assertion.

### assertDemeterLawCompliant($fqcn)
Asserts a class only knows itself and its close neighbours (Law of Demeter). 
This checking is very crude so I can't garantee it will work efficiently. 
Experimental.

### assertNoHiddenCoupling($fqcn)
Detects if parameters passed on to methods are actually objects without 
type-hinting which is a bad practice (design by contract
violation). Can't detect php tricks like reflection and call_user_func*().

## FAQ

### How does it work ?
It uses Reflection and also [nikic/PHPParser][6]. This is the main advantage to integrate this
tool into unit tests, because you have autoloading and it runs within a project
unlike a static code analyzer.

### Is it efficient ?
For performance concerns, this tool can make assertions only at the class scope, not the
whole project scope, so some SOLID principles cannot be completely asserted, it's 
not magic. The goal is to avoid bad pratices to pollute an originally well-coded source
not to be a SOLID-nazi. Think it like a "hack'n slash" for obvious bad practices.

By the way, if you think you've found another common OOP bad practice easy to detect, 
please contribute !

### But you cannot prevent someone to remove one of your assertion ?
That's right, but the git-blame will show you who has knowingly removed it. It's
much easier to track it and ignorance is no longer an excuse.

### SOLID principles are not as strict as you assert it ! Or some assertions
are not in the right principle.
That's not a question but I agree nonetheless. Many bad pratices don't break
one principle but two or three. The best example is the Singleton antipattern :
It breaks OCP because the singleton cannot be open for extension and it will break
DIP elsewhere because clients of this singleton will call for the unique instance 
instead of being injected with the instance. So, remember the subtitle :
"with an axe" :smile:

### Do you know that "testing does not mean freezing" ?
Yes, that's right. Perhaps, one would remove an assertion with good reason
during project development. The goal is not to put all these assertions 
on every class of your project. 

But I think 
assertInterfaceHintedParameter, assertNoHiddenCoupling should work **almost** everywhere.
It is essential assertInterfaceHintedParameter will pass on every interface you declare.
If your class is not a factory, assertHollywoodPrinciple should work too.
assertNotStaticFactory is a way to "lock" a creational design pattern.

assertNoMethodWithoutContract is very strict so it will work on a few cases (Facade, Decorator, Repository...).
assertLiskovCompliant should work on model classes because if you need reflection tricks 
within the model, you're doing it wrong. I realize an assertion like assertLiskovCompliant
has little chance to pass on a controller or a dispatcher and assertHollywoodPrinciple 
will fail obviously on creational design pattens. So be smart.

### Did you know one can easily workaround these assertions ?
That's right, for simplicity, this lib does not track hacks with ReflectionClass
or call_user_func(). If somebody has the time to hack this lib, I think she must
save that time and starts following SOLID.

### Is this a hating machine for your co-workers/contributors ?
Not at all, it's just a 1337-pass-filter to speed-up code review.
I've put effort into comprehensive error messages and by following the strict 
guidances of phpunit assertions, so debugging failed tests will be 
the standard procedure as usual.

### Did you know that some code fixtures are invalid ? (example, calling parent
without a base class) ?
Yes, I know. The code must compil, not run. Introspection with the 
PhpParser is sometime a pain in the ass to explore so I kept the code at
the minimum. Beside, code is sometime not really valid so this lib must adapt
without throwing an error each time a property is not declared.

## Soundtracks used for coding this library

 * Johann Sebastian Bach
 * Dream Theater
 * Ali Project

[1]: http://phpunit.de
[2]: http://en.wikipedia.org/wiki/Law_of_Demeter
[3]: http://en.wikipedia.org/wiki/SOLID_(object-oriented_design)
[4]: https://github.com/Trismegiste/Mondrian
[5]: http://getcomposer.org
[6]: https://github.com/nikic/PHP-Parser