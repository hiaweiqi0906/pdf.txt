import java.io.FilePermission;
import java.security.AccessController;

public class test {
  public static void main(String[] argv) throws Exception {
    // AccessController.checkPermission(new FilePermission("./*", "read,write"));
    String i = System.getProperty("user.name");
    System.out.println("ok");
    System.out.println("okkk");
    System.out.println(i);
  }
}