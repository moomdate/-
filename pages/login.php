
<div class="ui segment three column centered grid   ">
  <form class="ui form " method="post" action="?index=action&fn=login">
    <h2 class="ui icon header">
      <i class="key icon"></i>
      <div class="content">
        เข้าสู่ระบบ
        <div class="sub header">System 2 level</div>
      </div>
    </h2>
    <div class="ui large stacked segment ">
      <div class="field">
        <div class="ui left icon input">
          <i class="user icon"></i>
          <input type="text" name="username" placeholder="Username ">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="lock icon"></i>
          <input type="password"  name="password" placeholder="Password">
        </div>
      </div>
      <input class="ui fluid large teal submit button" type="submit" value="Login">
    </div>
    <div class="ui error message"></div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
  </form>

</div>

<script type="text/javascript">
  $(document).ready(function(){
   $('.ui.form').form({
    fields: {
      username :  {
        identifier: 'username',
        rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกชื่อผู้ใช้'
        }
        ]
      },
      password : {
        identifier: 'password',
        rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกรหัสผ่าน'
        },
        {
          type   : 'minLength[4]',
          prompt : 'รหัสผ่านของคุณไม่ควรน้อยกว่า {ruleValue} ตัวอักษร'
        }
        ]
      }
    }
  });
 });
</script>
