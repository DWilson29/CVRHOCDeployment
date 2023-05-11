
# Classroom VR for Heavy Civil Operations

A project for Dr. Joseph Louis at Oregon State University, code made by Matthew Attebery, Sam Schneider, D Wilson, Alex Yu


## Documentation

[Scene Hosting Documentation](https://docs.google.com/document/d/1-X64OJF1tYWViSAIz27k3BeRKXiG9s4M-N_R0QHtAFY/edit?usp=sharing)


## Diagram of Hosting Architecture

![Host Architecture](https://i.imgur.com/4nwETJN.png)


## Deployment

You can access our scenes by using the Unity editor. 

Additionally, webpages were created to serve and manage the scenes. The basic structure is shown below. 
```
public_html/
├─ classroom_vr/
│  ├─ sceneA/
│  ├─ sceneB/
│  ├─ sceneC/
│  ├─ index.php
│  ├─ login.php
│  ├─ script-upload.php
│  ├─ remove.php
│  ├─ 404.html
```
To deploy, you may download the webpages available in the repository and then upload them to your `public_html` directory on your web hosting server. You should be sure that your host can use PHP 8.1 to run the scene management scripts and interface. 


## User Stories

User stories were created by considering the project purpose from our project partner. These were through the minds of professors, students, and  other education-related positions/roles. 

1. As a developer, I need to develop a modular system so that it is an easily reusable system so that we can develop new scenes faster.
2. As a student who needs to access the scene viewing web app, I need to have a URL or QR code I can follow or scan so that I can access and understand the material being taught in the class. 
3. As an Oregon State University professor, I need a way to upload scenes for my students securely using an admin login so that they can view the scenes and I can provide a more hands-on and realistic learning experience. 
4. As a student in Dr. Louis’’s class, I need to be able to review problems from lecture from my desktop, so that I may study for exams.
5. As a developer, I need a server that can host multiple people, so users in different classes can use the server simultaneously. 
## Project Contributers

- [Matthew Attebery](https://www.linkedin.com/in/matthew-attebery/)
- [D Wilson](https://www.linkedin.com/in/dom-wilson-98981a17a/)
- [Sam Schneider](https://github.com/Schneider017)
- [Alex Yu](https://github.com/AlexYu84)


