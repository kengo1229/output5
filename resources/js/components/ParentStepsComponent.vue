<template>
<div class="p-step-group">
サボテン
    <div class="p-step  u-bg-white u-border-default u-margin-bottom-space_l" v-for="step in steps">
        <a class="p-step__link" :href="'/steps/' + step.id">
            <img v-if="step.pic != null" class="p-step__img" :src="step.pic.replace('public/', 'storage/')" alt="ステップ画像">
            <img v-else class="p-step__img" src="/img/no_image.jpg" alt="登録画像なし">
            <div class="p-step__body">
                <span class="u-underline-thin">タイトル</span>
                <p>{{step.title}}</p>
                <span class="u-underline-thin">カテゴリー</span>
                <p>{{step.category.category_name}}</p>
                <span class="u-underline-thin">達成目安時間</span>
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
            page: 1,
            steps: []
        }
    },
    methods: {
        getSteps() {

            let url = '/ajax/steps/?page=' + this.page;

            axios.get(url).then(({
                data
            }) => (this.steps = data.data));
        },


        movePage(page) {

            this.page = page;
            this.getSteps();

        }

    },
    mounted() {

        this.getSteps();

    }
}
</script>
