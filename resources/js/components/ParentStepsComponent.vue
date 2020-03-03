<template>
<div class="c-step-group">

    <div class="p-step  u-bg-white u-border-default" v-for="step in steps" :key="step.id">
        <a class="p-step__link" :href="'/steps/' + step.id">
            <img v-if="step.pic != null" class="p-step__img" :src="step.pic" alt="ステップ画像">
            <img v-else class="p-step__img" src="/img/no_image.jpg" alt="登録画像なし">
            <div class="p-step__body">
                <p class="u-underline-thin">タイトル</p>
                <p>{{ step.title.substr(0,23) }}</p>
                <p class="u-underline-thin">カテゴリー</p>
                <p>{{step.category.category_name}}</p>
                <p class="u-underline-thin">達成目安時間</p>
                <p>{{step.goal_time}}時間</p>
            </div>
        </a>
    </div>

</div>
</template>

<script>
export default {
    data: function() {
        return {
            steps: []
        }
    },
    mounted() {

        let url = 'ajax/steps';

        axios.get(url).then(({
            data
        }) => (this.steps = data));

    }
}
</script>
