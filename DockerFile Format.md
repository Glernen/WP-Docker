# "Dockerfile"的书写格式
### Docker 中制作镜像一共有两种方式：
1. 基于容器制作镜像：
```
docker commit ...
```
2. 基于Dockerfile制作镜像：
```
docker build ...
```

------------

### Dockerfile的制作步骤：
1. 创建一个目录；
2. 在目录中创建一个首字母大写的文件，供docker build识别；
3. 因为Dockerfile的执行环境在创建的目录中，所以可以创建相对应的文件，供dockerfile使用；

------------

### Dockerfile Format（Dockerfile的书写格式）
#### ·“#”开头的行是注释行（可以多行，任意位置）；

#### ·  INSTRUCTION arguments（指令说明）
1.  指令和对应的参数，建议指令大写，参数小写，默认大小写均可；
2.  能用一行指令完成，尽量不用多行指令；
3.  第一行可执行指令必须是FROM指令；

>  Docker是顺序执行Dockerfile中的内容，注意书写顺序；


#### Dockerfile中几个重要的指令：

**1. FROM （指定基准镜像）**

    FROM <repository>|:<tag> 或
    FROM <repository>@<digest>
    	<repository>：指定作为base image的名称；
    	<tag>：base image的标签，为可选项，省略时默认为latest；
    	ex：FROM busybox:latest

**2. LABEL（写入当前Dockerfile的制作者信息）**

    LABEL <key>=<value> <key>=<value> <key>=<value> …

**3. COPY（将宿主机的文件拷贝至镜像中）**

    COPY <src> … <dest> 或COPY ["<src>",... "<dest>" ]
    	<src>：要复制的源文件或目录，支持使用通配符；
    	<dest>：目标路径，即正在创建的image的文件系统路径；建议为<dest>使用绝对路径，否则，COPY指定则以WORKDIR为其起始路径；

> 注意：在路径中有空白字符时，通常使用第二种格式；

**4. ADD（类似于COPY指令，支持TAR文件和URL路径）**

    ADD <src> … <dest> 或ADD ["<src>",... "<dest>" ]

```
1.     如果<src>为URL且<dest>不以"/"结尾，则<src>指定的文件将被下载并直接被创建为<dest>
2.     如果<src>是一个本地系统上的压缩格式的tar文件，它将被展开为一个目录，其行为类似于"tar -x"命令；然而，通过URL获取到的tar文件将不会被自动展开
3.     如果<src>有多个，或其间接或直接使用了通配符，则<dest>必须是一个以"/"结尾的目录路径
4.     如果<dest>不以"/"结尾，则其被视作一个普通文件，<src>的内容将被直接写入到<dest>
5.     如果<dest>以"/"结尾，则文件名URL指定的文件将被下载并保存为<dest>/<filename>
```

**5. WORKDIR（用于为Dockerfile中所有的RUN, CMD, ENTRYPOINT, COPY和ADD指定设定工作目录；）**

    WORKDIR <dirpath>
    	在Dockerfile文件中，WORKDIR指令可出现多次，其路径也可以为相对路径，不过，其是相对此前一个WORKDIR指令指定的路径；
    	另外，WORKDIR也可以调用有ENV指定定义的变量；

**6.VOLUME（用于在image中创建一个挂载点目录，可以用于在Docker Host上挂载卷）；**

    VOLUME <mountpoint> 或 VOLUME ["mountpoint"]

> 个人并不建议使用：这是Docker daemon创建托管卷，并不是绑定挂载；

**7. EXPOSE（为容器打开要监听的端口，实现与外部的通信）；**

       EXPOSE <port>[/<protocol>] <port>[/<protocol>] <port>[/<protocol>] …
        	<protocol>用于指定传输层协议，可为TCP或UDP二者之一，默认为TCP；

**8.ENV（为镜像定义环境变量，可以被其他指令调用，build_time和run_time都可被使用）；**

    ENV <key> <value> 或 ENV <key>=<value>...
    	调用格式：$variable_name或${variable_name}

**9.ARG (在创建镜像是build_time使用的变量，一般用ARG写版本号和作者)；**

    ARG <name>[=<default value>]

**10.RUN（用于指定Docker build过程中运行的程序）；**

    RUN <command> 或
    RUN ["<excutable>","<param1>","<param2>",...]（json数组）


**11.CMD（类似于RUN命令，在run_time执行）；**

    CMD <command> 或
    CMD ["<excutable>","<param1>","<param2>",...] 或
    CMD ["<param1>","<param2>",...] (为ENTRYPOINT指令提供默认参数)


**12.ENTRYPOINT（类似于CMD指令）**

    ENTRYPOINT <command>
    ENTRYPOINT ["<excutable>","<param1>","<param2>",...]



