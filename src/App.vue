<template>
  <div id="app">
    <el-tabs v-model="activeName" type="card" @tab-click="handleClick">
      <el-tab-pane label="Dev" name="dev">
        <el-checkbox-group v-model="checkDev">
          <el-select v-model="selectDev" placeholder="Select">
            <el-option
              v-for="item in options"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
          <el-checkbox label="dev 1"></el-checkbox>
          <el-checkbox label="dev 2"></el-checkbox>
          <el-checkbox label="dev 3"></el-checkbox>
          <el-checkbox label="dev 4"></el-checkbox>
          <el-checkbox label="dev 5"></el-checkbox>
          <el-checkbox label="dev 6"></el-checkbox>
          <el-checkbox label="dev 7"></el-checkbox>
          <el-checkbox label="dev 8"></el-checkbox>
          <el-checkbox label="dev 9"></el-checkbox>
        </el-checkbox-group>
      </el-tab-pane>
      <el-tab-pane label="Beta" name="beta">
        <el-checkbox-group v-model="checkBeta">
          <el-select v-model="selectBeta" placeholder="Select">
            <el-option
              v-for="item in options"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
          <el-checkbox label="beta 1"></el-checkbox>
          <el-checkbox label="beta 2"></el-checkbox>
          <el-checkbox label="beta 3"></el-checkbox>
          <el-checkbox label="beta 4"></el-checkbox>
          <el-checkbox label="beta 5"></el-checkbox>
          <el-checkbox label="beta 6"></el-checkbox>
          <el-checkbox label="beta 7"></el-checkbox>
          <el-checkbox label="beta 8"></el-checkbox>
          <el-checkbox label="beta 9"></el-checkbox>
        </el-checkbox-group>
      </el-tab-pane>
      <el-tab-pane label="Gray" name="gray">
        <el-checkbox-group v-model="checkGray">
          <el-select v-model="selectGray" placeholder="Select">
            <el-option
              v-for="item in options"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
          <el-checkbox label="gray 1"></el-checkbox>
          <el-checkbox label="gray 2"></el-checkbox>
          <el-checkbox label="gray 3"></el-checkbox>
          <el-checkbox label="gray 4"></el-checkbox>
          <el-checkbox label="gray 5"></el-checkbox>
          <el-checkbox label="gray 6"></el-checkbox>
          <el-checkbox label="gray 7"></el-checkbox>
          <el-checkbox label="gray 8"></el-checkbox>
          <el-checkbox label="gray 9"></el-checkbox>
        </el-checkbox-group>
      </el-tab-pane>
    </el-tabs>
    <div>
      <el-button 
      class="submit-button"
      @click="submitClick">
        submit
      </el-button>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      options: [{
          value: 'mouth',
          label: 'mouth'
        }, {
          value: 'mobile',
          label: 'mobile'
        }, {
          value: 'admin',
          label: 'admin'
        }, {
          value: 'seller',
          label: 'seller'
        }, {
          value: 'includes',
          label: 'includes'
      }],
      activeName: 'dev',
      selectDev: '',
      selectBeta: '',
      selectGray: '',
      checkDev: [],
      checkBeta: [],
      checkGray: [],
    }
  },

  methods: {
    handleClick(tab, event) {
        // console.log(tab, event);
    },
    submitClick(){
      
    }
  }
}
</script>

<style>
body {
  font-family: Helvetica, sans-serif;
}
.submit-button {
  margin-top: 300px;
}
</style>
