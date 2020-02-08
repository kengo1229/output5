<template>
  <div class="card">
    <div class="card-body" v-for="step in steps" >
        <div v-if="step.pic != null">
          <img :src="step.pic.replace('public/', 'storage/')" alt="ステップ画像" width="200" height="130">
        </div>
        <div v-else>
          <img src="/img/no_image.jpg" alt="登録画像なし" width="200" height="130">
        </div>

        <h3 class="card-title">タイトル：
          <a :href="'/steps/' + step.id">
            {{step.title}}
          </a>
        </h3>
        <h3 class="card-title">カテゴリー：{{step.category.category_name}}</h3>
        <h3 class="card-title">達成目安時間：{{step.goal_time}}時間</h3>
    </div>
  </div>

</template>

<script>
    export default {
      data:function() {
        return{
          page: 1,
          steps:[]
        }
      },
      methods: {
        getSteps() {

            let url = '/ajax/steps/?page='+ this.page;

                  axios.get(url).then(({data}) => (this.steps = data.data));
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
