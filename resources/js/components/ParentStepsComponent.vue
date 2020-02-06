<template>
  <div class="card">
    <div class="card-body" v-for="parentStep in parentSteps" >
        <div v-if="parentStep.pic != null">
          <img :src="parentStep.pic.replace('public/', 'storage/')" alt="ステップ画像" width="200" height="130">
        </div>
        <div v-else>
          <img src="/img/no_image.jpg" alt="登録画像なし" width="200" height="130">
        </div>

        <h3 class="card-title">タイトル：
          <a :href="'/steps/' + parentStep.id">
            {{parentStep.title}}
          </a>
        </h3>
        <h3 class="card-title">カテゴリー：{{parentStep.category.category_name}}</h3>
        <h3 class="card-title">達成目安時間：{{parentStep.goal_time}}時間</h3>
    </div>
  </div>

</template>

<script>
    export default {
      data() {
        return{
          parentSteps:[]
        }
      },
      mounted() {
              let url = '/ajax/steps';
              axios.get(url).then(response => this.parentSteps = response.data)
      }
    }
</script>
