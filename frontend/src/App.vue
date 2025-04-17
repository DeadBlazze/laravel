<template lang="pug">
    header.header 
        nav 
            ul
                li 
                    router-link(to="/") Название
                li
                    router-link(to="/user-cabinet") Личный кабинет
    RouterView
</template>

<style scoped lang="scss">
header.header{
    padding: 0;
    margin: 0;
    nav{
        ul{
            border-bottom: 5px solid rgb(109, 109, 253);
            display: flex;
            justify-content: space-between;
            font-size: 1.5rem;
            padding: 1.7rem;
            margin: 0;
            li{
                all: unset;
                cursor: pointer;
                a{
                    all: unset;
                }
                a:hover{
                    color: rgb(109, 109, 253);
                }
            }
        }
    }
}
</style>
