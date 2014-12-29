###Command Line tricks

```
sudo date --set "01 Nov 2014 15:00:00"
```

```
sudo date {month}{day}{hour}{minute}{year}

```

###Clone repos from github

```
curl -u username:password https://api.github.com/orgs/org_name/repos\?per_page\=100 | ruby -rjson -e 'JSON.load(STDIN.read).each {|repo| %x[git clone #{repo["ssh_url"]} ]}'

```

```
 curl --user username:password https://api.bitbucket.org/2.0/repositories/user\?pagelen\=100 | ruby -rjson -e 'JSON.load(STDIN.read)["values"].each {|repo| ssh_link=repo["links"]["clone"].last["href"]; %x[git clone #{ssh_link}]}'
 ```
