# Music DB
A SQL database to store groups, albums and everything about music !

## Database

We have 4 tables : `group`, `album`, `member`, `award`.

![tables](./image/tables.jpg)

## Relations

We have the following relations:
- there is 1 `group` per `album`
- there is 1 `album` per `award`
- there is M `member` for N `album`

![relations](./image/relations.jpg)

## N to M Relationship

We want an album to recorde the work of many musicians.
And we also want musician to play in many albums. To represent this relation:
we create a new table indexing the relation between members and albums.

![N to M](./image/n_to_m.jpg)

## Initialize The Database

You can initialize the database with the command: `mysql < music_db.sql`