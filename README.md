# Notes REST API – Laravel

## Získanie všetkých poznámok

**URI**

```
http://localhost:8000/api/notes
```

![GET notes](images/get_note_index.png)

---

## Získanie jednej poznámky

**URI**

```
http://localhost:8000/api/notes/{id}
```

Príklad:

```
http://localhost:8000/api/notes/2
```

![GET note](images/get_note_show.png)

---

## Vytvorenie novej poznámky

**URI**

```
http://localhost:8000/api/notes
```

**Body**

```json
{
  "user_id": 2,
  "title": "Moja prvá poznámka",
  "body": "Toto je obsah poznámky."
}
```

![POST note](images/post_note_store.png)

---

## Aktualizácia poznámky

**URI**

```
http://localhost:8000/api/notes/{id}
```

Príklad:

```
http://localhost:8000/api/notes/4
```

**Body**

```json
{
  "title": "Nový názov poznámky",
  "body": "Toto je upravený obsah poznámky."
}
```

![PUT note](images/put_note_update.png)

---

## Odstránenie poznámky (soft delete)

**URI**

```
http://localhost:8000/api/notes/{id}
```

Príklad:

```
http://localhost:8000/api/notes/4
```

![DELETE note](images/delete_note_destroy.png)

---

# Vlastné endpointy

## Vyhľadávanie poznámok

Vyhľadáva poznámky podľa textu v **title** alebo **body**.

**URI**

```
http://localhost:8000/api/notes-actions/search?q=Laravel
```

![Search](images/get_note_search.png)

---

## Štatistika podľa statusu

**URI**

```
http://localhost:8000/api/notes/stats/status
```

![Stats](images/get_note_statsbystatus.png)

---

## Archivovanie starých draftov

**URI**

```
http://localhost:8000/api/notes/actions/archive-old-drafts
```

![Archive drafts](images/patch_note_archiveolddrafts.png)

---

## Poznámky používateľa s kategóriami

**URI**

```
http://localhost:8000/api/users/{user}/notes
```

Príklad:

```
http://localhost:8000/api/users/2/notes
```

![User notes](images/get_note_usernoteswithcategories.png)

---

## Vlastný endpoint – pinned notes

Endpoint vracia všetky pripnuté poznámky (`is_pinned = true`).

**URI**

```
http://localhost:8000/api/notes/actions/pinned
```

![Pinned notes](images/get_note_pinnednotes.png)

---

# Categories REST API – Laravel

## Získanie všetkých kategórií

**URI**

```
http://localhost:8000/api/categories
```

![GET categories](images/get_categories_index.png)

---

## Získanie jednej kategórie

**URI**

```
http://localhost:8000/api/categories/{id}
```

Príklad:

```
http://localhost:8000/api/categories/8
```

![GET category](images/get_category_show.png)

---

## Vytvorenie novej kategórie

**URI**

```
http://localhost:8000/api/categories
```

**Body**

```json
{
  "name": "Nová kategória"
}
```

![POST category](images/post_categories_store.png)

---

## Aktualizácia kategórie

**URI**

```
http://localhost:8000/api/categories/{id}
```

Príklad:

```
http://localhost:8000/api/categories/2
```

**Body**

```json
{
  "name": "school"
}
```

![PUT category](images/put_categories_update.png)

---

## Odstránenie kategórie

**URI**

```
http://localhost:8000/api/categories/{id}
```

Príklad:

```
http://localhost:8000/api/categories/6
```

![DELETE category](images/delete_categories_destroy.png)

---


---

# Testovanie API

API bolo testované pomocou nástroja **Postman**.
Každý endpoint bol overený pomocou HTTP requestov a odpovedí vo formáte **JSON**.

---

# Autor

Nikola Černá
