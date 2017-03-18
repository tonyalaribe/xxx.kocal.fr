<template>
    <div class="panel panel-primary" :class="{'visible': visible}">
        <div class="panel-heading" @click="visible = !visible">Toolbox</div>
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                visible: false
            }
        }
    }
</script>

<style scoped lang="scss" rel="stylesheet/scss">
    $panel-heading-height: 41px;

    .panel {
        position: fixed;
        top: 100%;
        right: 40px;

        transform: translate3D(0, -$panel-heading-height, 0);
        transition: transform .3s;

        &.visible {
            transform: translate3D(0, -100%, 0);
        }
    }

    .panel-heading {
        cursor: pointer;
    }
</style>