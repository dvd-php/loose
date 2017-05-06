<template>
  <div id="app">
    <el-tabs v-model="activeName" type="card" @tab-click="handleClick">
      <el-tab-pane label="Dev" name="dev">
        <el-checkbox-group v-model="checkDev">
          <div class="root-flag-select">
              <el-select v-model="selectDev" placeholder="Select" @change="getData">
                <el-option
                  v-for="item in options"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
          </div>
          <div class="root-flag-checkbox">
              <el-checkbox label="1"></el-checkbox>
              <el-checkbox label="2"></el-checkbox>
              <el-checkbox label="3"></el-checkbox>
              <el-checkbox label="4"></el-checkbox>
              <el-checkbox label="5"></el-checkbox>
              <el-checkbox label="6"></el-checkbox>
              <el-checkbox label="7"></el-checkbox>
              <el-checkbox label="8"></el-checkbox>
              <el-checkbox label="9"></el-checkbox>
          </div>
        </el-checkbox-group>
      </el-tab-pane>
      <el-tab-pane label="Beta" name="beta">
        <el-checkbox-group v-model="checkBeta">
          <div class="root-flag-select">
              <el-select v-model="selectBeta" placeholder="Select" @change="getData">
                <el-option
                  v-for="item in options"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
          </div>
          <div class="root-flag-checkbox">
              <el-checkbox label="1"></el-checkbox>
              <el-checkbox label="2"></el-checkbox>
              <el-checkbox label="3"></el-checkbox>
              <el-checkbox label="4"></el-checkbox>
              <el-checkbox label="5"></el-checkbox>
              <el-checkbox label="6"></el-checkbox>
              <el-checkbox label="7"></el-checkbox>
              <el-checkbox label="8"></el-checkbox>
              <el-checkbox label="9"></el-checkbox>
          </div>
        </el-checkbox-group>
      </el-tab-pane>
      <el-tab-pane label="Gray" name="gray">
        <el-checkbox-group v-model="checkGray">
          <div class="root-flag-select">
              <el-select v-model="selectGray" placeholder="Select" @change="getData">
                <el-option
                  v-for="item in options"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
          </div>
          <div class="root-flag-checkbox">
              <el-checkbox label="1"></el-checkbox>
              <el-checkbox label="2"></el-checkbox>
              <el-checkbox label="3"></el-checkbox>
              <el-checkbox label="4"></el-checkbox>
              <el-checkbox label="5"></el-checkbox>
              <el-checkbox label="6"></el-checkbox>
              <el-checkbox label="7"></el-checkbox>
              <el-checkbox label="8"></el-checkbox>
              <el-checkbox label="9"></el-checkbox>
           </div>
        </el-checkbox-group>
      </el-tab-pane>
    </el-tabs>
    <div>
      <el-button
      class="submit-button"
      type="primary"
      @click="submitClick">
        submit
      </el-button>
    </div>
    <div class="operation-alert" :class="{'hide': notshowSuccess}">
        <el-alert
        title="success"
        type="success"
        description="修改成功"
        show-icon>
      </el-alert>
    </div>
    <div class="operation-alert" :class="{'hide': notshowFail}">
        <el-alert
        title="fail"
        type="error"
        description="修改失败请重试"
        show-icon>
      </el-alert>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      options: [],
      activeName: 'dev',
      selectDev: 'mouth',
      selectBeta: 'mouth',
      selectGray: 'mouth',
      checkDev: [],
      checkBeta: [],
      checkGray: [],
      notshowSuccess: true,
      notshowFail: true
    }
  },

  mounted () {
      this.$nextTick(function () {
          this.getProject();
          this.getData();
      })
  },

  methods: {
    handleClick(tab, event) {
        this.getData();
        // console.log(tab, event);
    },
    submitClick() {
        var select, checkbox;
        switch (this.activeName) {
            case 'dev':
                select = this.selectDev
                checkbox = this.checkDev
                break;
            case 'beta':
                select = this.selectBeta
                checkbox = this.checkBeta
                break;
            case 'gray':
                select = this.selectGray
                checkbox = this.checkGray
                break;
            default:
            // 报错
        }
        var data = {api: 'update', env: this.activeName, project: select, checkbox: checkbox};
        var that = this;
        this.$http.post('/api.php', data).then(response => {
            var json = response.data;
            if (json.code !== 200) {
                // 报错
                that.notshowFail = false;
                setTimeout(function(){
                    that.notshowFail = true;
                },3000);
                return;
            }
            that.notshowSuccess = false;
            setTimeout(function(){
                that.notshowSuccess = true;
            },3000);
            return;
        }, response => {
            // 报错
            that.notshowFail = false;
            setTimeout(function(){
                that.notshowFail = true;
            },3000);
        });
    },
    getProject() {
        var data = {api: 'getProject'};
        var that = this;
        this.$http.post('/api.php', data).then(response => {
            var json = response.data;
            if (json.code !== 200) {
                // 报错
                return;
            }
            that.options = json.result.list;
        }, response => {
            // 报错
        });
    },
    getData() {
        var select;
        switch (this.activeName) {
            case 'dev':
                select = this.selectDev
                break;
            case 'beta':
                select = this.selectBeta
                break;
            case 'gray':
                select = this.selectGray
                break;
            default:
            // 报错
        }
        var data = {api: 'get', env: this.activeName, project: select};
        this.$http.post('/api.php', data).then(response => {
            var json = response.data;
            if (json.code !== 200) {
                // 报错
                return;
            }
            switch (this.activeName) {
                case 'dev':
                    this.checkDev = json.result.checkbox
                    break;
                case 'beta':
                    this.checkBeta = json.result.checkbox
                    break;
                case 'gray':
                    this.checkGray = json.result.checkbox
                    break;
                default:
                // 报错
            }
        }, response => {
            // 报错
        });
    }
  }
}
</script>

<style>
body {
  font-family: Helvetica, sans-serif;
}
.submit-button {
  position: absolute;
  top: 7px;
  right: 10px;
}
.root-flag-select{
    width: 200px;
    float: left;
}
.root-flag-checkbox{
    float: left;
    margin-left: 100px;
    margin-top: 7px;
}
.operation-alert{
    margin-top: 200px;
}
.hide{
    display: none;
}
</style>
