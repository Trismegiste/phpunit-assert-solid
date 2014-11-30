# SOLID Assertions for PHPUnit
Don't remind others the SOLID compliance, do it programatically

## When

Today is the day your programer's life has changed ! You're tired to endlessly remind
your team/github-users to follow SOLID principles ? Now it's over.

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
Sometimes you break a rule because you don't care. Sometimes, you break a rule because
of speed/memory optimization. Sometimes you break a rule because you don't
want to over-engineer objects (less is more). 
And sometimes, you break a rule because you forget it.

This tool is made for that.

## Where

In the unit tests. So you're sure some simple assertions are checked.

## Who

You decide how, how much and when one of your class must
follow one SOLID guidance. It does cover all guidances but those assertions
detects recurrent anti-patterns which could appear after many commits
from others until you discover it is too late. 

## Examples Please !

Of course
```php

```