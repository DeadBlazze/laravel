<template lang="pug">
    section.swimming__pool
        .wrapper
            h1 Бассейны.ру - Лучшие бассейны в Тюмени
            img.pool__photo(src='../assets/Home/swimming-pool.jpg')
            h2 Бассейн большой
            p Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            button
                router-link(to="/record-pool") Записаться 
</template>
<script>
export default {
}
</script>
<style lang="scss" scoped>
    .swimming__pool{
        .wrapper{
            padding: 0 10%;
            display: flex;
            flex-direction: column;
            h1{
                font-weight: 600;
            }
            .pool__photo{
                width: 100%;
                height: 500px;
                object-fit: cover;
            }
            h2{
                font-weight: 600;
            }
            p{
                font-size: 1.5rem;
                margin-top: 0;
            }
            button{
                align-self: flex-end;
                a{
                    all: unset;
                }
            }
        }
    }
</style>