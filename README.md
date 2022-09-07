# World of HIT (WoH) - Backend Challenge

Bienvenidos a World of HIT A.K.A. WoH. WoH es un juego MMORPG NO LINEAL.

El objetivo principal de este ejercicio es evaluar tu proceso para resolver problemas, como tu habilidad para escribir código entendible, limpio y reusable. No hay reglas estrictas o preguntas engañosas.

## Introduccion

Queremos desarrollar una API para un juego PvP (Player vs Player) donde dos jugadores se enfrentaran hasta que solo uno quede en pie. Los jugadores podrán tener equipados ítems que los ayuden en sus batallas.

## 📜 Instrucciones

### 🙍🏻‍♂️Jugador

- Cada jugador tiene:
- Nombre
- Email
- Tipo
- 👨🏻Humano
- 🧟‍♂️Zombie
- Al crearse un jugador comienza con ❤️ 100 puntos de vida.
- Si el jugador no tiene ítems, por defecto tiene 5 puntos de ataque 🗡 y 5 puntos de defensa 🛡.
- Los puntos de ataque 🗡 de un jugador están dados por sus 5 puntos + la sumatoria de puntos ataque de sus ítems.
- Los puntos de defensa 🛡 de un jugador están dados por sus 5 puntos + la sumatoria de puntos de defensa de sus ítems.

### ⚒ Ítems

- Cada ítem tiene:
- Nombre
- Tipo
- 🥾Bota
- 🧥Armadura
- ⚔️ Arma
- Cantidad de puntos de defensa 🛡. Pueden ser 0.
- Cantidad de puntos de ataque 🗡. Pueden ser 0.
- Un jugador puede tener equipado solo un ítem de cada tipo, pero puede tener un inventario con todos los ítems que quiera.

### 🤺Ataque

- Existen tres tipos de ataque:
- Cuerpo a cuerpo ⚔️. Daño total = Puntos de ataque.
- A distancia 🏹. Daño total = Puntos de ataque * 0.8.
- Ulti 💀. Daño total = Puntos de ataque x 2.
- Cada ataque le resta vida al otro jugador. La cantidad de vida que pierde el defensor es Daño total ataque - Puntos de defensa del defensor.
- Como mínimo un ataque saca 1 punto de ❤️ vida al defensor.
- Para tirar la Ulti el último ataque tuvo que haber sido un ataque a cuerpo a cuerpo.
- No se puede atacar a jugadores que ya están muertos.

## ✅ Tareas

Definir una REST API que permita cumplir con los siguientes requerimientos.

- Como administrador quiero dar de alta un jugador.
- Como administrador quiero dar de alta y modificar ítems.
- Como jugador quiero equiparme un ítem.
- Como jugador quiero atacar a otro jugador con un golpe cuerpo a cuerpo.
- Como jugador quiero atacar a otro jugador con un golpe a distancia.
- Como jugador quiero atacar a otro jugador con mi ulti.
- Como administrador queremos ver qué jugadores pueden tirar su ulti.

**Extras**

- Hacer test unitarios
- Hostear la solución

## 🤝 Entregable

- Se debe entregar un repo de github con la solución
- Puede estar programado en cualquier framework MVC. (si es en laravel mejor)


Corregido con https://www.corrector.co/es/
