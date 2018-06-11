# Install
1. Clone this repo in same folder (for example cloneFolder).

2. composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application
3. php /path/to/yii-application/init
4. common/config/main-local.php change components['db']

5. Copy and replace from clone folder (cloneFolder) in yii-application folder.

6. Make composer require ramsey/uuid

7. Apply migrate -> php /path/to/yii-application/yii migrate

8.
Frontend: frontend/web/index.php?r=product/index

Backend: backend/web/index.php?r=admin/index

9. Create Category,Product,Vendor and Check Product
