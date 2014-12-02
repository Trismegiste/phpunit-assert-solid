# SOLID Assertions for PHPUnit
Don't remind others the SOLID guidances, do it programatically... with an axe :smile:

## When

Today is the day your programer's life has changed ! You're tired to endlessly remind
your team/github-users to follow SOLID principles and Demeter's Law ? Now it's over.

## What

It's a library of assertions for the programer's best friend a.k.a : PHPUnit.
These assertions are not about how your classes behave but how your classes look like.
And particuliary, how classes don't break some elementary rules of OOP, mainly the SOLID
principles and Demeter's Law.

## How

This library does nothing by itself. It is NOT a static code analyzer, like many others
(you can see mine : Trismegiste/Mondrian ), it is more a helper for putting assertions
on SOLID compliance in unit tests. If a static code analyzer is a cure, this tool is
a vaccine.

### Add this lib to your project :
```bash
 $ composer.phar require --dev trismegiste/phpunit-assert-solid:dev-master
```

### use the trait in your phpunit unit test class :
```php
class ProjectTest extends PHPUnit_Framework_TestCase
{
    use \Trismegiste\SolidAssert\GoodPractice;  // <= this adds my new assertions
// see example/SimpleTest.php for a running example or below...
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

## API

### assertInterfaceHintedParameter($fqcn)
Asserts if all methods parameters for a given class are type-hinted with interface
and not class. (loose-coupling)

### assertNoMethodWithoutContract($fqcn)
Asserts if all public methods for a given class are first declared in an interface
implemented by this class. (design by contract and ISP)

### assertSmallApi($fqcn, $size)
Asserts if a given class has a small public api. Too many methods means too many
responsibilities (SRP). Default size is 5

### assertHollywoodPrinciple($fqcn)
Asserts there is no "new" nor Singleton calls in a given class. This ensures
object dependencies are injected in this class, not created. (DIP)

### assertLiskovCompliant($fqcn) 
Asserts there is no reflection "tricks" which would "undermine" LSP : is_subclass_of,
instanceof, method_exists and class_uses. There is exception for interfaces
because, it is less dangerous and a common pattern.

### assertNotStaticFactory($fqcn)
Asserts there is no new in a static method (typically a singleton and a static factory
are use-case) because it is a violation of OCP (and DIP as edge-effect). Standard
factories (Factory Method, Builder...) are not targeted by this assertion.

## FAQ

### How does it work ?
It uses Reflection and also nikic/PHPParser. This is the main advantage to integrate this
tool into unit tests, because you have autoloading and it runs within a project
unlike a static code analyzer.

### Is it efficient ?
For performance concerns, this tool can make assertions only at the class scope, not the
whole project scope, so some SOLID principles cannot be completely asserted, it's 
not magic. The goal is to avoid bad pratices to pollute an originally well-coded source
not to be a SOLID-nazi.

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
"with an axe".

### Did you know one can easily workaround these assertions ?
That's right, for simplicity, this lib does not track hack with ReflectionClass
or call_user_func(). If somebody has the time to hack this lib, I think she must
save that time and starts following SOLID.

### Is this a hating machine for your co-workers/contributors ?
No at all, it's just a 1337-pass-filter.
