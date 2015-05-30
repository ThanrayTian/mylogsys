#---------------------------------------------------------------------------------#
#                                                                                 #
#    这是一个简单的实现登录注册，登出，密码修改，找回等功能的PHP练手项目          #
#                                                                                 #
#---------------------------------------------------------------------------------#


#---------------------------------------------------------------------------------#
#                                                                                 #
#    设计方案如下：
#    1） 登录页面<-->注册页面
#                 -->个人主页
#                 -->忘记密码
#
#    2） 个人主页 -->登出
#                 -->修改密码
#
#---------------------------------------------------------------------------------#


#---------------------------------------------------------------------------------#
#    
#    1)预备函数文件：
#
#    a.显示部分：
#        output_fcns.php     :   do_html_header()
#                                do_html_footer()
#                                do_html_url()
#                                display_menu()
#                                display_login_form()
#                                display_register_form()
#                                display_change_passwd_form()
#                                display_forgot_passwd_form()
#                                display_reset_passwd_form()
#
#    b.数据检验：
#        data_valid_fcns.php :   filled_out()    #检验表单是否有漏填
#                                valid_email()   #检验email地址是否合法
#
#    c.数据库：
#        db_fcns.php         :   db_connect()    #尝试连接数据库(抛出异常)
#                                                #包含db用户名和passwd
#
#    d.用户方面：
#        user_auth_fcns.php  :   check_valid_user()  #检验是否已登录
#                               
#                                register()            #尝试注册(抛出异常)
#                                            #db连接,db中name判重,插入用户记录等
#
#                                login()             #尝试登录(抛出异常)
#                                            #db连接,db中name检索,密码验证等
#
#                                change_passwd()     #尝试修改密码(抛出异常)
#                                            #db连接,db密码验证,更新密码等
#
#                                passwd_findout_email() #尝试获取密码(抛出异常)
#                                            #db连接,db中name和email验证,email发送密码
#
#                                send_email()
#
#                                get_passwd()
#
#                                reset_passwd()
#
#
#    2)页面文件：
#        login_form.php
#        register_form.php
#        forgot_form.php
#        change_passwd_form.php
#        forgot_passwd_form.php
#
#
#    3)应用文件：
#
#        #输入检查,显示页面,异常处理
#
#        login.php
#        logout.php
#        register.php
#        change_passwd.php
#        reset_passwd.php
#
#    4)其他：
#        mylogsys.sql
#        mylogsys_fcns.php
