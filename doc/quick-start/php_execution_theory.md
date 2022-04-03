# PHP执行原理

目标：

+ 理解PHP执行原理，对标Java怎么在JVM上执行的
+ 理解PHP在Web服务器中的定位，做了什么工作



##　PHP执行原理

参考：[深入理解PHP内核](https://docs.kilvn.com/tipi/)

这里只展示少量最重要的信息，详细内容如有需要参考对应资料。

PHP可以用于开发服务端程序（主要领域）、命令行工具、甚至桌面应用程序。

### 本地代码解释执行原理

![](https://docs.kilvn.com/tipi/images/chapt02/02-00-php-inernal.png)

上面PHP内核就是指Zend虚拟机，Zend虚拟机器主要分为３层：解释层、中间数据层、执行引擎，感觉和JVM虚拟机（也分三层：类加载子系统、运行时数据区、执行引擎，不过Java词法分析、语法分析是由javac完成的，而PHP中这些工作是Zend虚拟机完成的）类似。

<img src="https://docs.kilvn.com/tipi/images/chapt07/07-01-01-zend-vm.png" style="zoom:50%;" />

解释层的编译器会将PHP编译成opcode。 如果安装了apc之类的opcode缓存， 编译环节可能会被跳过而直接从缓存中读取opcode执行（JVM也有JIT对热点代码的即时编译）。

### PHP在Web服务器中的角色和执行原理

#### 嵌入HTML执行的原理

为何PHP可以嵌入到网页中(虽然现在看PHP Web开发也前后分离了)？是不是和JSP有些类似？

这部分需要先了解下CGI，参考网文：[CGI是什么](https://www.jianshu.com/p/c4dc22699a42)

早期动态网页Web架构：

<img src="https://upload-images.jianshu.io/upload_images/4933701-87bd067080e29526.png?imageMogr2/auto-orient/strip|imageView2/2/format/webp" style="zoom: 67%;" />

CGI是（Common Gateway Interface）通用网关接口，Web服务器本身不支持直接运行动态脚本，但是为了支持动态网页技术，就需要拓展可以运行动态脚本的模块（称为CGI程序），Web服务器需要支持CGI协议，然后这些模块通过CGI与Web服务器通信；Web服务器接收到包含动态脚本的网页请求，就将脚本通过CGI发给CGI程序执行，再将结果返回给Web服务器，Web服务器再对结果进行渲染什么的，返回格式化的文档。

CGI工作原理：

![](https://upload-images.jianshu.io/upload_images/4933701-a2e95da7aff59a83.png?imageMogr2/auto-orient/strip|imageView2/2/format/webp)

Nginx通过CGI协议执行PHP原理:

<img src="https://upload-images.jianshu.io/upload_images/4933701-e703e723a3b68026.png?imageMogr2/auto-orient/strip|imageView2/2/format/webp" style="zoom:80%;" /> 

PHP对CGI协议的实现就是PHP-CGI，也就是PHP的解释器。

后来某些Web服务器为了提升效率内部也集成了CGI模块。

CGI后来又发展出了改进版本：FastCGI，是常驻型的CGI，可以一直运行。

Nginx通过FastCGI协议执行PHP原理:

![](https://upload-images.jianshu.io/upload_images/4933701-3ce5f8f55a95f6b3.png?imageMogr2/auto-orient/strip|imageView2/2/format/webp)

PHP对FastCGI协议的实现是PHP-FPM，内部运行着PHP解释器（应该说是PHP虚拟机吧）。



#### 前后端分离执行的原理

和CGI没什么关系了，都是Ajax接口请求。

这种情况下应该和本地执行代码差不多。

为何Java有Tomcat、Jetty等Web服务器，但是PHP没有？

因为Java只定义了Servlet接口没有实现HTTP服务器实现，而PHP以及其他GO、JS都是默认有提供实现的。

