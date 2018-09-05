# Eloquent beahviour - Sortable

Set the position of an element in a ordered Collection, and update the list element order automatically

Automatically append new elements to the tail of the collection

## Preface

This can be done easily using different approaches

### Straight update of N rows

* Easy
* *N+1 queries* - O(n)
* Huge performance bottlneck (and possibly complete stall)

### Reordering with CASE - THEN SQL statements

* Moderate
* 1+1 queries - O(1)
* It's fine in most cases, just doesn't scale up very nice to thousands of rows (since it generates a huge SQL statement)

### Using Float numbers for storing the position

* Easy
* Only 2 queries - O(1)
* Problematic if the ordering has to be shown somewhere, since the float number has to be converted to an integer

### Using this eloquent behaviour

* Moderate
* 1+1 queries = O(1)
