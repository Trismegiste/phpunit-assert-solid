# SOLID Assertions for PHPUnit
Don't remind others the SOLID compliance, do it programatically

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
on SOLID compliance in unit tests.

## Why

Well, no one can force you to launch an analyzer unless some pre-commit 
hooks are set. Futhermore, even best analyzer cannot detect minor 
problem (specially with soft-typed language like PHP). Sometime those analyzers
detects false negative so you can't put strict assertions based on those analyzers reports.

Besides, in pratice no one need a strict SOLID compliance for the whole project.
Sometime you break a rule because you don't care. Sometime, you break a rule because
of speed/memory optimization. Sometime you break a rule because you don't
want to over-engineer objects (less is more). And sometime, you break a rule 
because you forget it.

This tool is made for that.

## Where

In the unit tests. So you're sure some simple assertions are checked.

## Who

You decide how, how much and when one of your class must
follow one SOLID guidance. It does not cover all guidances but those assertions
detect recurrent anti-patterns which could appear after many commits
from others until you discover it is too late. 

## Examples Please !

Of course
```php

```

## FAQ

### How does it work ?
It uses Reflection and also nikic/PHPParser. This is the main advantage to integrate this
tool into unit tests, because you have autoloading and it runs within a project
unlike a static code analyzer.

### Is it efficient ?
For performance issue, this tool can make assertions at the class level, not the
whole project level so some SOLID principle cannot be completely asserted, it's 
not magic. The goal is to avoid bad pratices to pollute an originally well-coded source.

### But you cannot prevent someone to remove one of your assertion ?
That's right, but the git-blame will show you who has knowingly removed it. It's
much easier to track so ignorance is no longer an excuse.

### SOLID principles are not as strict as you assert it ! Or some assertions
are not in the right principle trait.
That's not a question but I agree nonetheless. Many bad pratices don't break
one principle but two or three. The best example is the Singleton antipattern :
It breaks OCP because the singleton cannot be open for extension and it breaks
DIP because clients of this singleton will call for the unique instance 
instead of being injected with an unique (or not) instance. So I have splitted
every assertion in traits with a principle "flavour".

One other way could be to group assertions by anti-patterns. But since main 
guidance is SOLID, I prefer this way.