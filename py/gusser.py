import requests

ratget_url= "http://127.0.0.1:5500/html/login.html"
data_dir = {"username":"admin","password":"DSSZD49Q","login":"submit"}
respones = requests.post(ratget_url, data=data_dir)
print(respones.content)