# 0001. Laravel ως framework

**Ημερομηνία:** 2026-10-09 · **Κατάσταση:** Αποδεκτή

## Απόφαση

Το gateway γράφεται σε **Laravel 13**.

## Γιατί

- Το ξέρω από το 2014. Με 3–5 ώρες την εβδομάδα, ο χρόνος μου πρέπει να πηγαίνει σε αυτά που ήρθα να μάθω (transactions, locks, idempotency, queues), όχι στην εκμάθηση ενός framework.
- Έχει έτοιμα όσα δεν είναι ο στόχος του project: routing, DI container, migrations, queue, testing.
- Τρέχει σε PHP 8.5 και υποστηρίζει PostgreSQL με `FOR UPDATE` / `SKIP LOCKED`, που θα χρειαστώ στη Φάση 1.

## Τι απέρριψα

- **Symfony:** το μισό project θα ήταν εκμάθηση Symfony και Doctrine.
- **Χωρίς framework (Slim / plain PHP):** θα έγραφα routing και DI από το μηδέν, που δεν είναι ο στόχος.

## Τι κοστίζει

Το Laravel κάνει εύκολο να **μη δω τι γίνεται στη βάση**. Ένα `$payment->save()` μέσα σε `DB::transaction()` μοιάζει σωστό, αλλά μπορεί να μην είναι. Γι' αυτό, μέσα στη διαδρομή του χρήματος (ledger, payments, refunds, outbox):

1. Κάθε transaction είναι ρητό. Ποτέ «το κάνει το framework».
2. Τα queries με lock γράφονται με query builder ή raw SQL που διαβάζεται, όχι μέσα από Eloquent relationships.
3. Κανένα model event, observer ή `dispatch()` μέσα σε transaction χρήματος.
4. Το SQL που εκτελείται το διαβάζω τουλάχιστον μία φορά ανά endpoint (`DB::listen`).

## Πότε θα άλλαζα γνώμη

Αν ο στόχος μου γινόταν θέσεις Symfony. Τότε το ίδιο project θα ήταν ο καλύτερος τρόπος να το μάθω.
